@extends('admin.dashboard.master')
@section('title', 'User')
@section('header')
    @include('admin.dashboard.header')
@endsection
@section('nav')
    @include('admin.dashboard.nav')
@endsection
@section('page', 'User')
@section('main')
    @include('admin.dashboard.main')
    <!-- Main page content-->
    <div class="container-xl px-4 mt-n10">
        <div class="card mb-4">
            <div class="card-header">User Form</div>
            <div class="card-body">
                <form action="{{route('user.store')}}" id="frmUser" method="POST">
                    @csrf
                    <div class="mb-3 ms-3 me-3">
                        <label for="name">Name</label>
                        <input class="form-control" id="name" name="name" type="text" placeholder="Name" aria-label="Name">
                    </div>
                    <div class="mb-3 ms-3 me-3">
                        <label for="email">Email Address</label>
                        <input class="form-control" id="email" name="email" type="email" placeholder="Email" aria-label="Email">
                    </div>
                    <div class="mb-3 ms-3 me-3">
                        <label for="password">Password</label>
                        <input class="form-control" id="password" name="password" type="password" placeholder="Password" aria-label="Password">
                    </div>
                    <div class="mb-3 ms-3 me-3">
                        <label for="name">Role</label>
                        <select class="form-select" aria-label="Default select example" name="role" id="role">
                            <option selected value="default">Select Role</option>
                            <option value="admin">Admin</option>
                            <option value="user">User</option>
                            <option value="owner">Owner</option>
                        </select>
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
                            <a href="{{ route('user.index') }}" class="btn btn-danger w-100">Cancel</a>
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
        const form = document.getElementById("frmUser")
        const nm = document.getElementById("name")
        const email = document.getElementById("email")
        const pass = document.getElementById("password")
        const rl = document.getElementById("role")

        function save() {
            if (nm.value == "") {
                nm.focus()
                swal("Incomplete data", "Name must be filled!", "error")
            } else if (email.value == "") {
                email.focus()
                swal("Incomplete data", "Email must be filled!", "error")
            } else if (pass.value == "") {
                pass.focus()
                swal("Incomplete data", "Password must be filled!", "error")
            } else if (rl.value == "default") {
                rl.focus()
                swal("Incomplete data", "Role must be selected!", "error")
            } else {
                form.submit()
            }
        }

        btnSave.onclick = function() {
            save()
        }
    </script>
@endsection
