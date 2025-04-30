@extends('admin.dashboard.master')
@section('title', 'Product')
@section('header')
    @include('admin.dashboard.header')
@endsection
@section('nav')
    @include('admin.dashboard.nav')
@endsection
@section('page', 'Product')
@section('main')
    @include('admin.dashboard.main')
    <!-- Main page content-->
    <div class="container-xl px-4 mt-n10">
        <div class="card mb-4">
            <div class="card-header">Product Form</div>
            <div class="card-body">
                <form action="{{ route('product.store') }}" id="frmProduct" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3 ms-3 me-3">
                        <label for="category_name" class="form-label">Product Category Name</label>
                        <select class="form-select" name="product_category_id" id="product_category_id">
                            <option @if (isset($product_category_id)) selected @endif value="default">
                                Open this select menu
                            </option>

                            @foreach ($product_categories as $data)
                                <option value="{{ $data->id }}" @if (isset($product_category_id) and $data->id == $product_category_id) selected @endif>
                                    {{ $data->category_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3 ms-3 me-3">
                        <label for="product_name" class="form-label">Product Name</label>
                        <input class="form-control" id="product_name" name="product_name" placeholder="Product Name">
                    </div>

                    <div class="mb-3 ms-3 me-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" type="text" placeholder="Desciption"></textarea>
                    </div>

                    <div class="mb-3 ms-3 me-3">
                        <label for="price" class="form-label">Price</label>
                        <input class="form-control" id="price" name="price" type="text" placeholder="Price">
                    </div>

                    <div class="mb-3 ms-3 me-3">
                        <label for="stok_quantity" class="form-label">Stock</label>
                        <input class="form-control" id="stok_quantity" name="stok_quantity" type="number"
                            placeholder="Stock">
                    </div>

                    <div class="mb-3 ms-3 me-3">
                        <label for="image1_url" class="form-label">First Image</label>
                        <input type="file" id="image1_url" name="image1_url" class="form-control"
                            placeholder="First Image" aria-label="First Image">
                    </div>

                    <div class="mb-3 ms-3 me-3">
                        <label for="image2_url" class="form-label">Second Image</label>
                        <input type="file" id="image2_url" name="image2_url" class="form-control"
                            placeholder="Second Image" aria-label="Second Image">
                    </div>

                    <div class="mb-3 ms-3 me-3">
                        <label for="image3_url" class="form-label">Third Image</label>
                        <input type="file" id="image3_url" name="image3_url" class="form-control"
                            placeholder="Third Image" aria-label="Third Image">
                    </div>

                    <div class="mb-3 ms-3 me-3">
                        <label for="image4_url" class="form-label">Fourth Image</label>
                        <input type="file" id="image4_url" name="image4_url" class="form-control"
                            placeholder="Fourth Image" aria-label="Fourth Image">
                    </div>

                    <div class="mb-3 ms-3 me-3">
                        <label for="image5_url" class="form-label">Fiveth Image</label>
                        <input type="file" id="image5_url" name="image5_url" class="form-control"
                            placeholder="Fiveth Image" aria-label="Fiveth Image">
                    </div>

                    <div class="mb-3 ms-3 me-3">
                        <label for="slug" class="form-label">Slug</label>
                        <input class="form-control" id="slug" name="slug" placeholder="Slug">
                    </div>

                    <div class="row ms-3 me-3 text-right justify-content-end">
                        <div class="col-3">
                            <a href="{{ route('product.index') }}" class="btn btn-danger w-100">Cancel</a>
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
        const btnSave = document.getElementById('save')
        const form = document.getElementById('frmProduct')
        const pc = document.getElementById('product_category_id')
        const pn = document.getElementById('product_name')
        const desc = document.getElementById('description')
        const prc = document.getElementById('price')
        const stk = document.getElementById('stok_quantity')
        const img1 = document.getElementById('image1_url')
        const img2 = document.getElementById('image2_url')
        const img3 = document.getElementById('image3_url')
        const img4 = document.getElementById('image4_url')
        const img5 = document.getElementById('image5_url')
        const slug = document.getElementById('slug')

        function save() {
            if (pc.value === "default") {
                pc.focus()
                swal("Incomplete Data", "Product Category must be selected!", "error")
            } else if (pn.value === "") {
                pn.focus()
                swal("Incomplete Data", "Product Name is required!", "error")
            } else if (desc.value === "") {
                desc.focus()
                swal("Incomplete Data", "Description is required!", "error")
            } else if (prc.value === "") {
                prc.focus()
                swal("Incomplete Data", "Price is required!", "error")
            } else if (stk.value === "") {
                stk.focus()
                swal("Incomplete Data", "Stock is required!", "error")
            } else if (img1.value === "") {
                img1.focus()
                swal("Incomplete Data", "First Image is required!", "error")
            } else if (img2.value === "") {
                img2.focus()
                swal("Incomplete Data", "Second Image is required!", "error")
            } else if (img3.value === "") {
                img3.focus()
                swal("Incomplete Data", "Third Image is required!", "error")
            } else if (img4.value === "") {
                img4.focus()
                swal("Incomplete Data", "Fourth Image is required!", "error")
            } else if (img5.value === "") {
                img5.focus()
                swal("Incomplete Data", "Fiveth Image is required!", "error")
            } else if (slug.value === "") {
                slug.focus()
                swal("Incomplete Data", "Slug is required!", "error")
            } else {
                form.submit();
            }
        }

        btnSave.onclick = function() {
            save()
        }

        prc.onkeypress = function(e) {
            number(e);
        }
    </script>
@endsection
