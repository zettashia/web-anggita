<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductCategories;
use App\Models\ProductReview;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Support\Facades\Auth;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, $categorySlug = null)
    {
        $categorySelected = null;
        $sort = $request->get('sort');

        $categories = ProductCategories::all();
        $productsQuery = Product::query();

        if (!empty($categorySlug)) {
            $category = ProductCategories::where('slug', $categorySlug)->first();
            if ($category) {
                $productsQuery->where('product_category_id', $category->id);
                $categorySelected = $category->id;
            }
        }

        if ($request->get('sort')) {
            if ($request->get('sort') == 'low') {
                $productsQuery->orderBy('price', 'ASC');
            } else {
                $productsQuery->orderBy('price', 'DESC');
            }
        } else {
            $productsQuery->orderByDesc('id');
        }

        $products = $productsQuery->orderByDesc('id')->paginate(9);
        return view('landing-page.shop', compact('products', 'categories', 'categorySelected', 'sort'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function product_detail($slug)
    {
        $productDetails = Product::where('slug', $slug)->firstOrFail();
        $reviews = ProductReview::where('product_id', $productDetails->id)->get();
        return view('landing-page.product-detail', compact('productDetails', 'reviews'));
    }


public function storeReview(Request $request, $productId)
{
    $this->validate($request, [
        'rating' => 'required|integer|min:1|max:5',
        'comment' => 'required|string',
    ]);

    $user = Auth::user();

    // dd($user->id);

    $rating = ProductReview::create([
        'user_id' => $user->id,
        'product_id' => $productId,
        'rating' => $request->rating,
        'comment' => $request->comment,
    ]);

    // dd($rating);

    return redirect()->back()->with('success', 'Review submitted successfully!');
}


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
