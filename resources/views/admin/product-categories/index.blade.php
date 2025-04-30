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
            <div class="card card-header-actions">
                <div class="card-header">
                    List Product Category
                    <a href="{{ route('product-categories.create') }}" class="btn btn-primary">Add Product Category</a>
                </div>
            </div>
            <div class="card-body">
                <table id="datatablesSimple" class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Category Name</th>
                            <th>Image</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($productCategories as $idx => $data)
                            <tr>
                                <td>{{ $idx + 1 }}</td>
                                <td>{{ $data->category_name }}</td>
                                <td width="40%">
                                    <img src="{{ asset('storage/' . $data->image_url) }}" class="img-thumbnail">
                                </td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Category Actions">
                                        <form action="{{ route('product-categories.edit', $data->id) }}" method="GET">
                                            @csrf
                                            <button type="submit" class="btn btn-info">
                                                <i class="fas fa-edit"></i> Edit
                                            </button>
                                        </form>
                                        <form action="{{ route('product-categories.destroy', $data->id) }}" method="POST"
                                            onsubmit="return confirm('Are you sure you want to delete this product category?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">
                                                <i class="fas fa-trash-alt"></i> Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @if (Session::has('message'))
        <script>
            swal("Good job!", "{{ Session::get('message') }}", "success");
        </script>
    @endif
@endsection
