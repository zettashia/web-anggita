@extends('admin.dashboard.master')
@section('title', 'Customers')
@section('header')
    @include('admin.dashboard.header')
@endsection
@section('nav')
    @include('admin.dashboard.nav')
@endsection
@section('page', 'Customers')
@section('main')
    @include('admin.dashboard.main')
    <!-- Main page content-->
    <div class="container-xl px-4 mt-n10">
        <div class="card mb-4">
            <div class="card-header">Customers Form</div>
            <div class="card-body">
                <form action="{{ route('customer.update', $customers->id) }}" id="frmCustomer" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3 ms-3 me-3">
                        <label for="first_name" class="form-label">Fisrt Name</label>
                        <input class="form-control" id="first_name" name="first_name" type="text" placeholder="First Name" aria-label="Fisrt Name" value="{{ $customers->first_name }}">
                    </div>

                    <div class="mb-3 ms-3 me-3">
                        <label for="last_name" class="form-label">Last Name</label>
                        <input class="form-control" id="last_name" name="last_name" type="text" placeholder=" Last Name" aria-label="Last Name" value="{{ $customers->last_name }}">
                    </div>

                    <div class="mb-3 ms-3 me-3">
                        <label for="email" class="form-label">Email</label>
                        <input class="form-control" id="email" name="email" type="email" placeholder="Email" aria-label="Email" value="{{ $customers->email }}">
                    </div>

                    <div class="mb-3 ms-3 me-3">
                        <label for="phone_number" class="form-label">Phone Number</label>
                        <input class="form-control" id="phone_number" name="phone_number" type="number" placeholder="Phone Number" aria-label="Phone Number" value="{{ $customers->phone_number }}">
                    </div>

                    <div class="mb-3 ms-3 me-3">
                        <label for="address" class="form-label">Address</label>
                        <input class="form-control" id="address" name="address" type="text" placeholder="Address" aria-label="Address" value="{{ $customers->address }}">
                    </div>

                    <div class="mb-3 ms-3 me-3">
                        <label for="city" class="form-label">City</label>
                        <input class="form-control" id="city" name="city" type="text" placeholder="City" aria-label="City" value="{{ $customers->city }}">
                    </div>

                    <div class="mb-3 ms-3 me-3">
                        <label for="state" class="form-label">State</label>
                        <input class="form-control" id="state" name="state" type="text" placeholder="State" aria-label="State" value="{{ $customers->state }}">
                    </div>

                    <div class="mb-3 ms-3 me-3">
                        <label for="zip" class="form-label">Zip Code</label>
                        <input class="form-control" id="zip" name="zip" type="number" placeholder="Zip Code" aria-label="Zip Code" value="{{ $customers->zip }}">
                    </div>

                    <div class="row ms-3 me-3 text-right justify-content-end">
                        <div class="col-3">
                            <a href="{{ route('customer.index') }}" class="btn btn-danger w-100">Cancel</a>
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
        const form = document.getElementById("frmCustomer")
        const fnm = document.getElementById("first_name")
        const lnm = document.getElementById("last_name")
        const email = document.getElementById("email")
        const phone = document.getElementById("phone_number")
        const addr = document.getElementById("address")
        const city = document.getElementById("city")
        const state = document.getElementById("state")
        const zip = document.getElementById("zip")

        function save() {
            if (fnm.value == "") {
                fnm.focus()
                swal("Incomplete data", "Fisrt Name must be filled!", "error")
            } else if (lnm.value == "") {
                lnm.focus()
                swal("Incomplete data", "Last Name must be filled!", "error")
            } else if (email.value == "") {
                email.focus()
                swal("Incomplete data", "Email must be filled!", "error")
            } else if (phone.value == "") {
                phone.focus()
                swal("Incomplete data", "Phone must be filled!", "error")
            } else if (addr.value == "") {
                addr.focus()
                swal("Incomplete data", "Address must be filled!", "error")
            } else if (city.value == "") {
                city.focus()
                swal("Incomplete data", "City must be filled!", "error")
            } else if (state.value == "") {
                state.focus()
                swal("Incomplete data", "State must be filled!", "error")
            } else if (zip.value == "") {
                zip.focus()
                swal("Incomplete data", "Zip Code must be filled!", "error")
            } else {
                form.submit()
            }
        }

        btnSave.onclick = function() {
            save()
        }
    </script>
@endsection
