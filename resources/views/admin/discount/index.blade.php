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
            <div class="card card-header-actions">
                <div class="card-header">
                    List Discount
                    <a href="{{ route('discount.create') }}" class="btn btn-primary">Add Discount</a>
                </div>
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Code</th>
                            <th>Name</th>
                            <th>Type</th>
                            <th>Discount Amount</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($discount as $idx => $data)
                            <tr>
                                <td>
                                    <div class="d-flex px-2 py-1">
                                        {{ $idx + 1 . '. ' }}
                                    </div>
                                </td>
                                <td>
                                    {{ $data->code }}
                                </td>
                                <td>
                                    {{ $data->name }}
                                </td>
                                <td>
                                    {{ $data->type }}
                                </td>
                                <td>
                                    @if ($data->type == 'percentage')
                                        {{ $data->discount_amount }}%
                                    @else
                                        Rp {{ number_format($data->discount_amount, 0, ',', '.') }}                                    @endif
                                </td>
                                <td>
                                    {{ $data->start_date }}
                                </td>
                                <td>
                                    {{ $data->end_date }}
                                </td>
                                <td>
                                    <span class="{{ $data->status == '1' ? 'badge bg-success' : 'badge bg-danger' }}">
                                        {{ $data->status == '1' ? 'Active' : 'InActive' }}
                                    </span>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div>
                                            <a href="{{ route('discount.edit', $data->id) }}"
                                                class="btn btn-datatable btn-icon btn-transparent-dark me-2"><i
                                                    data-feather="edit" style="color: blue"></i></a>
                                        </div>
                                        <form action="{{ route('discount.destroy', $data->id) }}" method="post">
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
