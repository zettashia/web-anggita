@extends('admin.dashboard.master')
@section('title', 'Order')
@section('header')
    @include('admin.dashboard.header')
@endsection
@section('nav')
    @include('admin.dashboard.nav')
@endsection
@section('page', 'Order')
@section('main')
    @include('admin.dashboard.main')
    <!-- Main page content-->
    <div class="container-xl px-4 mt-n10">
        <div class="card mb-4">
            <div class="card-header">Order Form</div>
            <div class="card-body">
                <form action="{{ route('order.update', $orders->id) }}" id="frmOrder" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3 ms-3 me-3">
                        <label for="order_no" class="form-label">Order Number</label>
                        <input class="form-control" id="order_no" name="order_no" type="text"
                            value="{{ $orders->order_no }}" disabled>
                    </div>

                    <div class="mb-3 ms-3 me-3">
                        <label for="first_name" class="form-label">Name</label>
                        <input class="form-control" id="first_name" name="first_name" type="text"
                            value="{{ $orders->first_name . ' ' . $orders->last_name }}" disabled>
                    </div>

                    <div class="mb-3 ms-3 me-3">
                        <label for="order_date" class="form-label">Order Date</label>
                        <input class="form-control" id="order_date" name="order_date" type="datetime-local"
                            placeholder="Order Date" aria-label="Order Date" value="{{ $orders->order_date }}" disabled>
                    </div>

                    <div class="mb-3 ms-3 me-3">
                        <label for="address" class="form-label">Product</label>
                        <input class="form-control" id="address" name="address" type="text"
                        @foreach ($orders->items as $item) value="{{ $item->product->product_name }} x {{ $item->quantity }}" @endforeach disabled>
                    </div>

                    <div class="mb-3 ms-3 me-3">
                        <label for="total_amount" class="form-label">Total Amount</label>
                        <input class="form-control" id="total_amount" name="total_amount" type="text" placeholder="Total Amount"
                            aria-label="Total Amount" value="{{ $orders->total_amount }}" disabled>
                    </div>

                    <div class="mb-3 ms-3 me-3">
                        <label for="payment_status">Payment Status</label>
                        <select class="form-select" aria-label="Default select example" name="payment_status" id="payment_status">
                            <option selected value="default">Select Payment Status</option>
                            <option value="not_paid" {{ $orders->payment_status == 'not_paid' ? 'selected' : '' }}>Not Paid</option>
                            <option value="paid" {{ $orders->payment_status == 'paid' ? 'selected' : '' }}>Paid</option>
                        </select>
                    </div>

                    <div class="mb-3 ms-3 me-3">
                        <label for="status">Status</label>
                        <select class="form-select" aria-label="Default select example" name="status" id="status">
                            <option selected value="default">Select Status</option>
                            <option value="pending" {{ $orders->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="shipped" {{ $orders->status == 'shipped' ? 'selected' : '' }}>Shipped</option>
                            <option value="delivered" {{ $orders->status == 'delivered' ? 'selected' : '' }}>Delivered</option>
                            <option value="cancelled" {{ $orders->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                    </div>

                    <div class="mb-3 ms-3 me-3">
                        <label for="delivered_date" class="form-label">Delivered Date</label>
                        <input class="form-control" id="delivered_date" name="delivered_date" type="datetime-local"
                            placeholder="Delivered Date" aria-label="Delivered Date" value="{{ $orders->delivered_date }}">
                    </div>

                    <div class="row ms-3 me-3 text-right justify-content-end">
                        <div class="col-3">
                            <a href="{{ route('order.index') }}" class="btn btn-danger w-100">Cancel</a>
                        </div>

                        <div class="col-3">
                            <button type="button" class="btn btn-success w-100" id="save">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        const btnSave = document.getElementById("save")
        const form = document.getElementById("frmOrder")
        const ps = document.getElementById("payment_status")
        const st = document.getElementById("status")

        function save() {
            if (ps.value === "default") {
                ps.focus()
                swal("Incomplete Data", "Payment Status is required!", "error")
            } else if (st.value === "default") {
                st.focus()
                swal("Incomplete Data", "Status is required!", "error")
            } else {
                form.submit();
            }
        }

            btnSave.onclick = function() {
                save()
            }
    </script>
@endsection
