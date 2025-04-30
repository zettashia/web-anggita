<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\Customer;
use App\Models\User;
use App\Models\Order;
use App\Models\OrderDetail;

class AuthController extends Controller
{
    public function login()
    {
        return view('landing-page.account.login');
    }

    public function register()
    {
        return view('landing-page.account.register');
    }

    public function auth(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {
            return redirect()->route('account.profile');
        } else {
            return redirect()->route('account.login')->with('error', 'Email or Password incorrect');
        }
    }

    public function profile()
    {
        $user = User::where('id', Auth::id())->first();

        return view('landing-page.account.my_account', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        User::updateOrCreate(
            ['id' => $user->id],
            [
                'name' => $request->name,
                'email' => $request->email
            ],
        );

        return redirect()->back();
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('account.login')
            ->with('success', 'Logout successfully');
    }

    public function storeRegister(Request $request)
    {
        $data = $request->only([
            'name',
            'email',
            'password',
        ]);

        User::create($data);
        session()->flash('success', 'You have been registered succesfully');

        return redirect()->back();
    }

    public function address(Request $request)
    {
        $user = User::where('id', Auth::id())->first();
        $customer = Customer::where('user_id', $user->id)->first();

        return view('landing-page.account.address', compact('customer'));
    }
    /**
     * Remove the specified resource from storage.
     */
    public function orders()
    {
        $customer = Customer::where('user_id', Auth::id())->first();
        $orders = Order::where('customer_id', $customer->id)->get();

        return view('landing-page.account.orders', compact('orders'));
    }

    public function orderDetail(string $id)
    {
        $user = User::where('id', Auth::id())->first();
        $customer = Customer::where('user_id', $user->id)->first();
        $order = Order::where('orders.id', $id)
        ->select('orders.*')
        ->where('orders.customer_id', $customer->id)
        ->leftJoin('customers', 'customers.id', '=', 'orders.customer_id')
        ->first();

        $orderDetail = OrderDetail::where('order_id', $id)
        ->leftJoin('products', 'order_details.product_id', '=', 'products.id')
        ->select('order_details.*', 'products.*')
        ->get();

        return view('landing-page.account.order-detail', compact('order', 'orderDetail'));
    }
}
