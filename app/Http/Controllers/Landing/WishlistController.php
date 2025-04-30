<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;

class WishlistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $wishlistCount = Cart::instance('wishlist_' . $user->id)->count();
        $wishlistItems = Cart::instance('wishlist_' . $user->id)->content();
        return view('landing-page.wishlist', compact('wishlistItems', 'wishlistCount'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function addWishlist(Request $request)
    {
        $id = $request->id;
        $user = Auth::user();
        $product = Product::find($id);
        Cart::instance('wishlist_' . $user->id)->add(
            $id,
            $product->product_name,
            1,
            $product->price,
            [
                'image' => $product->image1_url,
                'user_id' => $user->id,
            ]
        );

        $message = '<strong>' . $product->product_name . '<strong> added to wishlist successfully.';
        session()->flash('success', $message);
        return redirect()->back();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function removeWishlist(Request $request)
    {
        $user = Auth::user();
        $itemInfo = Cart:: instance('wishlist_' . $user->id)->get($request->rowId);
        Cart:: instance('wishlist_' . $user->id)->remove($request->rowId);

        $message = 'Item removed successfully.';
        session()->flash('success', $message);

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
