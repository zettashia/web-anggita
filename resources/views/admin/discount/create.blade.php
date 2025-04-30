@extends('admin.dashboard.master')
@section('title', 'Discount')
@section('header')
    @include('admin.dashboard.header')
@endsection
@section('nav')
    @include('admin.dashboard.nav')
@endsection
@section('page', 'Discount')
@section('main')
    @include('admin.dashboard.main')
    <!-- Main page content-->
    <div class="container-xl px-4 mt-n10">
        <div class="card mb-4">
            <div class="card-header">Discount Form</div>
            <div class="card-body">
                <form action="{{ route('discount.store') }}" id="frmDiscount" method="POST">
                    @csrf
                    <div class="mb-3 ms-3 me-3">
                        <label for="code" class="form-label">Code</label>
                        <input class="form-control" id="code" name="code" type="text" placeholder="Code"
                            aria-label="Code">
                    </div>

                    <div class="mb-3 ms-3 me-3">
                        <label for="name" class="form-label">Name</label>
                        <input class="form-control" id="name" name="name" type="text" placeholder="Name"
                            aria-label="Name">
                    </div>

                    <div class="mb-3 ms-3 me-3">
                        <label for="type">Type</label>
                        <select class="form-select" aria-label="Default select example" name="type" id="type">
                            <option selected value="default">Select Type</option>
                            <option value="percentage">Precentage</option>
                            <option value="fixed">Fixed</option>
                        </select>
                    </div>

                    <div class="mb-3 ms-3 me-3">
                        <label for="discount_amount" class="form-label">Discount Amount</label>
                        <input class="form-control" id="discount_amount" name="discount_amount" type="number"
                            placeholder="Discount Amount" aria-label="Discount Amount">
                    </div>

                    <div class="mb-3 ms-3 me-3">
                        <label for="start_date" class="form-label">Start Date</label>
                        <input class="form-control" id="start_date" name="start_date" type="datetime-local"
                        placeholder="Start Date" aria-label="Start Date">
                    </div>

                    <div class="mb-3 ms-3 me-3">
                        <label for="end_date" class="form-label">End Date</label>
                        <input class="form-control" id="end_date" name="end_date" type="datetime-local" placeholder="End Date"
                        aria-label="End Date">
                    </div>

                    <div class="mb-3 ms-3 me-3">
                        <label for="status">Status</label>
                        <select class="form-select" aria-label="Default select example" name="status" id="status">
                            <option selected value="default">Select Status</option>
                            <option value="1">Active</option>
                            <option value="0">InActive</option>
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
        const form = document.getElementById("frmDiscount")
        const code = document.getElementById("code")
        const nm = document.getElementById("name")
        const tp = document.getElementById("type")
        const da = document.getElementById("discount_amount")
        const st = document.getElementById("status")
        const sd = document.getElementById("start_date")
        const ed = document.getElementById("end_date")

        function save() {
            if (code.value === "") {
                code.focus()
                swal("Incomplete Data", "Code must be selected!", "error")
            } else if (nm.value === "") {
                nm.focus()
                swal("Incomplete Data", "Name is required!", "error")
            } else if (tp.value === "default") {
                tp.focus()
                swal("Incomplete Data", "Type must be selected!", "error")
            } else if (da.value === "") {
                da.focus()
                swal("Incomplete Data", "Discount Amount is required!", "error")
            } else if (st.value === "default") {
                st.focus()
                swal("Incomplete Data", "Status must be selected!", "error")
            } else if (sd.value === "") {
                sd.focus()
                swal("Incomplete Data", "Start Date is required!", "error")
            } else if (ed.value === "") {
                ed.focus()
                swal("Incomplete Data", "End Date is required!", "error")
            } else {
                form.submit();
            }
        }

            btnSave.onclick = function() {
                save()
            }
    </script>
@endsection
