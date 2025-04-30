<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Discount;

class DiscountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $discount = Discount::all();
        return view('admin.discount.index', compact('discount'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.discount.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->only([
            'code',
            'name',
            'type',
            'discount_amount',
            'start_date',
            'end_date',
            'status'
        ]);
        Discount::create($data);
        return redirect()->route('discount.index')->with('message', 'The new discount data with the name '. $request->name . ' has been sucessfully saved!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $discount = Discount::find($id);
        return view('admin.discount.edit', compact('discount'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = Discount::find($id);

        $request->validate([
            'code' =>
            'required|unique:discount,code,'.$id
        ]);

        $data->update($request->all());
        $data->save();
        return redirect()->route('discount.index')->with('message', 'Discount data with the name '. $request->name . ' updated sucessfully saved!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Discount::where('id', $id)->delete();
        return back()->with('message', 'Data delete successfully!');
    }
}
