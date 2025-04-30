<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\ProductCategories;

class ProductCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $productCategories = ProductCategories::all();
        return view('admin.product-categories.index', compact('productCategories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.product-categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = DB::table('product_categories')->where('category_name', '=', $request->category_name)->value('category_name');
        if ($data) {
            return view('admin.product-categories.create', [
                'status' => 'duplicate',
                'category_name' => $request->category_name,
                'image_url' => $request->image_url,
                'slug' => $request->slug
            ]);
        } else {
            $data = $request->only([
                'category_name', 'image_url', 'slug'
            ]);
            // Simpan gambar di public storage
            if ($request->hasFile('image_url')) {
                $data['image_url'] = $request->file('image_url')->store('ProductCategories/Photos', 'public');
            }
    
            ProductCategories::create($data);
            return redirect()->route('product-categories.index')->with('message', 'The new product category data with the name '. $request->category_name . ' has been successfully saved!');
        }
    }
    
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $productCategory = ProductCategories::findOrFail($id);
        return view('admin.product-categories.show', compact('productCategory'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $productCategory = ProductCategories::findOrFail($id);
        return view('admin.product-categories.edit', compact('productCategory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = ProductCategories::findOrFail($id);
        $data->category_name = $request->category_name;
        if ($request->file('image_url') != null) {
            if ($data->image_url) {
                // Hapus gambar lama
                Storage::disk('public')->delete($data->image_url);
            }
            // Simpan gambar baru
            $data->image_url = $request->file('image_url')->store('ProductCategories/Photos', 'public');
        }
        $data->slug = $request->slug;
        $data->save();
        return redirect()->route('product-categories.index')->with('message', 'Product category data with the name '. $request->category_name . ' updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = ProductCategories::findOrFail($id);
        if ($data->image_url) {
            // Hapus gambar
            Storage::disk('public')->delete($data->image_url);
        }
        $data->delete();
        return back()->with('message', 'Data deleted successfully!');
    }
}
