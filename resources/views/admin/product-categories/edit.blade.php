@extends('admin.dashboard.master')
@section('title', 'Product Category')
@section('header')
    @include('admin.dashboard.header')
@endsection
@section('nav')
    @include('admin.dashboard.nav')
@endsection
@section('page', 'Product Category')
@section('main')
    @include('admin.dashboard.main')
    <!-- Main page content-->
    <div class="container-xl px-4 mt-n10">
        <div class="card mb-4">
            <div class="card-header">Edit Product Category Form</div>
            <div class="card-body">
                <form action="{{ route('product-categories.update', $productCategory->id) }}" id="frmProduct_Category" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-3 ms-3 me-3">
                        <label for="category_name" class="form-label">Product Category Name</label>
                        <input class="form-control" id="category_name" name="category_name" type="text" value="{{ $productCategory->category_name ?? '' }}" placeholder="Product Category Name" aria-label="Product Category Name">
                    </div>

                    <div class="mb-3 ms-3 me-3">
                        <label for="image_url" class="form-label">Image</label>
                        <div class="flex">
                            <img src="{{ asset('storage/' . $productCategory->image_url) }}" alt="" class="img-thumbnail mb-3" width="10%">
                            <input type="file" id="image_url" name="image_url" class="form-control" placeholder="Image" aria-label="Image">
                        </div>
                    </div>

                    <div class="mb-3 ms-3 me-3">
                        <label for="slug" class="form-label">Slug</label>
                        <input class="form-control" id="slug" name="slug" placeholder="Slug" value="{{ $productCategory->slug ?? '' }}">
                    </div>

                    <div class="row ms-3 me-3 text-right justify-content-end">
                        <div class="col-3">
                            <a href="{{ route('product-categories.index') }}" class="btn btn-danger w-100">Cancel</a>
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
        const btnSave = document.getElementById("save");
        const form = document.getElementById("frmProduct_Category");
        const pc = document.getElementById("category_name");
        const slug = document.getElementById("slug");

        function save() {
            if (pc.value === "") {
                pc.focus();
                swal("Incomplete Data", "Product Category Name is required!", "error");
            } else if (slug.value === "") {
                slug.focus();
                swal("Incomplete Data", "Slug is required!", "error");
            } else {
                form.submit();
            }
        }

        btnSave.onclick = function() {
            save();
        }
    </script>
@endsection
