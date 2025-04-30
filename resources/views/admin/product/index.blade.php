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
            <div class="card card-header-actions">
                <div class="card-header">
                    List Product
                    <a href="{{ route('product.create') }}" class="btn btn-primary">Add Product</a>
                </div>
            </div>
            <div class="card-body table-responsive">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Category Name</th>
                            <th>Product Name</th>
                            <th>Description</th>
                            <th>Price</th>
                            <th>Stok</th>
                            <th>1st Image</th>
                            <th>2nd Image</th>
                            <th>3rd Image</th>
                            <th>4th Image</th>
                            <th>5th Image</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $idx => $data)
                            <tr>
                                <td>
                                    <div class="d-flex px-2 py-1">
                                        {{ $idx + 1 . '. ' }}
                                    </div>
                                </td>
                                <td>
                                    {{ $data->category->name }}
                                </td>

                                @if (strlen($data->product_name) > 5)
                                    <td data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $data->product_name }}"
                                        style="cursor: help">
                                        {{ substr($data->product_name, 0, 5) . '...' }}
                                    </td>
                                @else
                                    <td>{{ $data->product_name }}</td>
                                @endif

                                @if (strlen($data->description) > 5)
                                    <td data-bs-toggle="tooltip" data-bs-placement="right"
                                        data-bs-custom-class="custom-tooltip" title="{{ $data->description }}"
                                        style="cursor: help">
                                        {{ substr($data->description, 0, 5) . '...' }}
                                    </td>
                                @else
                                    <td>{{ $data->description }}</td>
                                @endif

                                <td>
                                    Rp {{ number_format($data->price, 0, ',', '.') }}
                                </td>
                                <td>
                                    {{ $data->stok_quantity }}
                                </td>
                                <td>
                                    <img src="{{ asset('storage/' . $data->image1_url) }}" alt="{{ $data->image1_url }}"
                                        class="img-thumbnail">
                                </td>
                                <td>
                                    <img src="{{ asset('storage/' . $data->image2_url) }}" class="img-thumbnail">
                                </td>
                                <td>
                                    <img src="{{ asset('storage/' . $data->image3_url) }}" class="img-thumbnail">
                                </td>
                                <td>
                                    <img src="{{ asset('storage/' . $data->image4_url) }}" class="img-thumbnail">
                                </td>
                                <td>
                                    <img src="{{ asset('storage/' . $data->image5_url) }}" class="img-thumbnail">
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div>
                                            <a href="{{ route('product.edit', $data->id) }}"
                                                class="btn btn-datatable btn-icon btn-transparent-dark me-2"><i
                                                    data-feather="edit" style="color: blue"></i></a>
                                        </div>
                                        <form action="{{ route('product.destroy', $data->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" id="delete" onclick="return confirm('Are you sure?')"
                                                class="btn btn-datatable btn-icon btn-transparent-dark"><i
                                                    data-feather="trash-2" style="color: red"></i></button>
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