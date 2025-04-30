<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Discount;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderDetail;
use Carbon\Carbon;

class CartController extends Controller
{
    public function addCart(Request $request)
    {
        $id = $request->id;
        $user = Auth::user();
        $product = Product::find($id);
        // dd($id);
        Cart::instance('cart_' . $user->id)->add(
            $id,
            $product->product_name,
            1,
            $product->price,
            [
                'image' => $product->image1_url,
                'user_id' => $user->id,
            ]
        );
        // dd(Cart::content());
        $message = '<strong>' . $product->product_name . '<strong> added to cart successfully.';
        session()->flash('success', $message);
        return redirect()->back();
    }

    public function cart()
    {
        $user = Auth::user();
        $cartItems = Cart::instance('cart_' . $user->id)->content();
        $cartCount = Cart::instance('cart_' . $user->id)->count();
        return view('landing-page.cart', compact('cartItems', 'cartCount'));
    }

    public function updateCart(Request $request)
    {
        $user = Auth::user();
        $rowId = $request->rowId;
        $qty = $request->qty;

        $itemInfo = Cart::instance('cart_' . $user->id)->get($rowId);
        $product = Product::find($itemInfo->id);

        if ($qty <= $product->stok_quantity) {
            Cart::instance('cart_' . $user->id)->update($rowId, $qty);
            $message = 'Cart updated successfully.';
            $status = true;
            session()->flash('success', $message);
        } else {
            $message = 'Request qty(' . $qty . ') not available in stock.';
            $status = false;
            session()->flash('error', $message);
        }

        return redirect()->back();
    }

    public function deleteCart(Request $request)
    {
        $user = Auth::user();
        Cart::instance('cart_' . $user->id)->remove($request->rowId);

        $message = 'Item removed successfully.';
        session()->flash('success', $message);
        return redirect()->back();
    }

    public function applyDiscount(Request $request)
    {
        // dd($request->code);
        $code = Discount::where('code', $request->code)->first();

        if ($code == null) {
            return redirect()->back()->with('discountResponse', [
                'status' => false,
                'message' => 'Invalid or Expired Discount Code.'
            ]);
        }

        // Check if coupon start date is valid
        $now = Carbon::now();

        if ($code->start_date != "") {
            $startDate = Carbon::createFromFormat('Y-m-d H:i:s', $code->start_date);

            if ($now->lt($startDate)) {
                return redirect()->back()->with('discountResponse', [
                    'status' => false,
                    'message' => 'Invalid or Expired Discount Code.'
                ]);
            }
        }

        if ($code->end_date != "") {
            $endDate = Carbon::createFromFormat('Y-m-d H:i:s', $code->end_date);

            if ($now->gt($endDate)) {
                return redirect()->back()->with('discountResponse', [
                    'status' => false,
                    'message' => 'Invalid or Expired Discount Code.'
                ]);
            }
        }

        session()->put('code', $code);

        $user = Auth::user();
        $discount = 0;
        $subTotal = Cart::instance('cart_' . $user->id)->subtotal(0, '.', '');

        if ($code->type == 'percentage') {
            $discount = ($code->discount_amount / 100) * $subTotal;
        } else {
            $discount = $code->discount_amount;
        }

        // Check if fixed discount amount exceeds subtotal
        if ($discount > $subTotal) {
            return redirect()->back()->with('discountResponse', [
                'status' => false,
                'message' => 'Discount amount exceeds subtotal. Invalid Discount Code.'
            ]);
        }

        $grandTotal = $subTotal - $discount;

        $response = [
            'status' => true,
            'grandTotal' => number_format($grandTotal, 0, '.', ''),
            'discount' => number_format($discount, 0, '.', ''),
            'discountString' => 'Discount applied successfully!'
        ];

        session()->put('discountResponse', $response);

        // dd(session('discountResponse'));

        return redirect()->back()->with('discountResponse', $response);
    }

    public function checkout()
    {
        $customer = Customer::where('user_id', Auth::id())->first();
        $cartItems = Cart::instance('cart_' . Auth::id())->content();
        // dd($cartItems);
        return view('landing-page.checkout', compact('customer', 'cartItems'));
    }

    public function saveCustomer(Request $request)
    {
        //store customer data
        $user = Auth::user();
        Customer::updateOrCreate(
            ['user_id' => $user->id],
            [
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'phone_number' => $request->phone_number,
                'address' => $request->address,
                'city' => $request->city,
                'state' => $request->state,
                'zip' => $request->zip,
                'notes' => $request->notes
            ],
        );

        return redirect()->back();
    }

    public function proccesCheckout(Request $request)
    {
        $request->validate([
            'payment_method' => 'required',
            'bank_name' => 'required_if:payment_method,transfer',
            'card_number' => ($request->payment_method == 'transfer') ? 'required|numeric' : ''
        ], [
            'bank_name.required_if' => 'Bank name is required when payment method is transfer.',
            'card_number.required' => 'Card number is required when payment method is transfer.',
            'card_number.numeric' => 'Card number must be a valid number.'
        ]);
    
        $user = Auth::user();
        $customer = Customer::where('user_id', $user->id)->first();
    
        // Get subtotal from shopping cart
        $subTotal = Cart::instance('cart_' . $user->id)->subtotal(0, '.', '');
    
        // Get discount information from session
        $discountResponse = session('discountResponse');
        $discount = $discountResponse['discount'] ?? 0;
    
        // Calculate grand total
        $grandTotal = $subTotal - $discount;
    
        // Create new Order instance
        $order = new Order;
        $order->order_no = '#ORD-' . sprintf('%02d', Order::count() + 1); // Example order number generation
        $order->customer_id = $customer->id;
        $order->order_date = Carbon::now();
        $order->subtotal = $subTotal;
        $order->discount_id = session('code')->id ?? null;
        $order->discount = $discount;
        $order->total_amount = $grandTotal; // Assign grand total here
        $order->payment_method = $request->payment_method;
    
        if ($request->payment_method == 'transfer') {
            $order->payment_status = 'paid';
            $order->bank_name = $request->bank_name;
            $order->card_number = $request->card_number;
        } else {
            $order->payment_status = 'not_paid';
        }
    
        $order->status = 'pending';
        $order->save();
    
        // Save order details
        $cartItems = Cart::instance('cart_' . $user->id)->content();
        foreach ($cartItems as $cartItem) {
            $orderDetail = new OrderDetail;
            $orderDetail->order_id = $order->id;
            $orderDetail->product_id = $cartItem->id;
            $orderDetail->quantity = $cartItem->qty;
            $orderDetail->price = $cartItem->price;
            $orderDetail->total = $cartItem->price * $cartItem->qty;
            $orderDetail->save();
        }
    
        // Update product stock
        foreach ($cartItems as $cartItem) {
            $product = Product::find($cartItem->id);
            $product->stok_quantity -= $cartItem->qty;
            $product->save();
        }
    
        // Clear shopping cart
        Cart::instance('cart_' . $user->id)->destroy();
    
        return redirect()->route('success')->with('success', 'Order successfully created. Wait for admin approval.');
    }
    
    public function success()
    {
        return view('landing-page.success');
    }
}
