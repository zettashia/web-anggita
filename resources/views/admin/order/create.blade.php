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
                <form action="{{ route('order.store') }}" id="frmOrder" method="POST">
                    @csrf
                    <div class="mb-3 ms-3 me-3">
                        <label for="name" class="form-label">Name</label>
                        <select class="form-select" name="customer_id" id="customer_id">
                            <option @if (isset($customer_id)) selected @endif value="default">
                                Choose the customer name
                            </option>

                            @foreach ($customers as $data)
                                <option value="{{ $data->id }}" @if (isset($customer_id) and $data->id == $customer_id) selected @endif>
                                    {{ $data->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3 ms-3 me-3">
                        <label for="order_date" class="form-label">Order Date</label>
                        <input class="form-control" id="order_date" name="order_date" type="datetime-local"
                            placeholder="Order Date" aria-label="Order Date">
                    </div>

                    <div class="mb-3 ms-3 me-3">
                        <label for="total_amount" class="form-label">Total Amount</label>
                        <input class="form-control" id="total_amount" name="total_amount" type="text" placeholder="Total Amount"
                            aria-label="Total Amount">
                    </div>

                    <div class="mb-3 ms-3 me-3">
                        <label for="status">Status</label>
                        <select class="form-select" aria-label="Default select example" name="status" id="status">
                            <option selected value="default">Select Status</option>
                            <option value="pending">Pending</option>
                            <option value="processing">Processing</option>
                            <option value="completed">Completed</option>
                            <option value="cancelled">Cancelled</option>

                        </select>
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
        const ci = document.getElementById("customer_id")
        const od = document.getElementById("order_date")
        const ta = document.getElementById("total_amount")
        const st = document.getElementById("status")

        function save() {
            if (ci.value === "default") {
                ci.focus()
                swal("Incomplete Data", "Name is required!", "error")
            } else if (od.value === "") {
                od.focus()
                swal("Incomplete Data", "order Date is required!", "error")
            } else if (ta.value === "") {
                ta.focus()
                swal("Incomplete Data", "Total Amount must be selected!", "error")
            } else if (st.value === "default") {
                st.focus()
                swal("Incomplete Data", "Status must be selected!", "error")
            } else {
                form.submit();
            }
        }

            btnSave.onclick = function() {
                save()
            }
    </script>
@endsection
