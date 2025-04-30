<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Order;
use App\Models\Customer;
use App\Models\OrderDetail;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::latest('orders.created_at')
            ->select('orders.*', 'customers.first_name', 'customers.last_name', 'customers.email')
            ->leftJoin('customers', 'customers.id', 'orders.customer_id')
            ->with('items.product')
            ->get();

        return view('admin.order.index', compact('orders'));
    }

    public function edit(string $id)
    {
        $orders = Order::select('orders.*', 'customers.first_name', 'customers.last_name', 'customers.email')->where('orders.id', $id)->leftJoin('customers', 'customers.id', 'orders.customer_id')->first();
        return view('admin.order.edit', compact('orders'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $order = Order::find($id);
        $order->payment_status = $request->payment_status;
        $order->status = $request->status;
        $order->delivered_date = $request->delivered_date;
        $order->save();

        return redirect()->route('order.index')->with('message', 'Order data with the name ' . $request->name . ' updated sucessfully saved!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
