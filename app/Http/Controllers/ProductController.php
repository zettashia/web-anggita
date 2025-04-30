<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductCategories;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Menggunakan Eloquent untuk mengambil data produk dan kategori
        $products = Product::with('category')->get();
        return view('admin.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.product.create', [
            'product_categories' => ProductCategories::all()
        ]);
    }

        /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $product_categories = ProductCategories::all();
        return view('admin.product.edit', compact('product', 'product_categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_category_id' => 'required|exists:product_categories,id',
            'product_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'stok_quantity' => 'required|integer',
            'image1_url' => 'required|image',
            'image2_url' => 'nullable|image',
            'image3_url' => 'nullable|image',
            'image4_url' => 'nullable|image',
            'image5_url' => 'nullable|image',
            'slug' => 'required|string|max:255|unique:products,slug'
        ]);
    
        $data = $request->only([
            'product_category_id', 'product_name', 'description', 'price', 'stok_quantity', 'slug'
        ]);
    
        if ($request->hasFile('image1_url')) {
            $data['image1_url'] = $request->file('image1_url')->store('Products/Photos', 'public');
        }
        if ($request->hasFile('image2_url')) {
            $data['image2_url'] = $request->file('image2_url')->store('Products/Photos', 'public');
        }
        if ($request->hasFile('image3_url')) {
            $data['image3_url'] = $request->file('image3_url')->store('Products/Photos', 'public');
        }
        if ($request->hasFile('image4_url')) {
            $data['image4_url'] = $request->file('image4_url')->store('Products/Photos', 'public');
        }
        if ($request->hasFile('image5_url')) {
            $data['image5_url'] = $request->file('image5_url')->store('Products/Photos', 'public');
        }
    
        Product::create($data);
        return redirect()->route('product.index')->with('message', 'The new product data with the name ' . $request->product_name . ' has been successfully saved!');
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'product_category_id' => 'required|exists:product_categories,id',
            'product_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'stok_quantity' => 'required|integer',
            'image1_url' => 'nullable|image',
            'image2_url' => 'nullable|image',
            'image3_url' => 'nullable|image',
            'image4_url' => 'nullable|image',
            'image5_url' => 'nullable|image',
            'slug' => 'required|string|max:255|unique:products,slug,' . $id
        ]);
    
        $product = Product::findOrFail($id);
        $product->fill($request->only([
            'product_category_id', 'product_name', 'description', 'price', 'stok_quantity', 'slug'
        ]));
    
        if ($request->hasFile('image1_url')) {
            if ($product->image1_url) {
                Storage::disk('public')->delete($product->image1_url);
            }
            $product->image1_url = $request->file('image1_url')->store('Products/Photos', 'public');
        }
        if ($request->hasFile('image2_url')) {
            if ($product->image2_url) {
                Storage::disk('public')->delete($product->image2_url);
            }
            $product->image2_url = $request->file('image2_url')->store('Products/Photos', 'public');
        }
        if ($request->hasFile('image3_url')) {
            if ($product->image3_url) {
                Storage::disk('public')->delete($product->image3_url);
            }
            $product->image3_url = $request->file('image3_url')->store('Products/Photos', 'public');
        }
        if ($request->hasFile('image4_url')) {
            if ($product->image4_url) {
                Storage::disk('public')->delete($product->image4_url);
            }
            $product->image4_url = $request->file('image4_url')->store('Products/Photos', 'public');
        }
        if ($request->hasFile('image5_url')) {
            if ($product->image5_url) {
                Storage::disk('public')->delete($product->image5_url);
            }
            $product->image5_url = $request->file('image5_url')->store('Products/Photos', 'public');
        }
    
        $product->save();
        return redirect()->route('product.index')->with('message', 'Product ' . $request->product_name . ' updated successfully!');
    }
}        