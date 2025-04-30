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
            <div class="card card-header-actions">
                <div class="card-header">
                    List Customers
                    <a href="{{ route('customer.create') }}" class="btn btn-primary">Add Customer</a>
                </div>
            </div>
            <div class="card-body table-responsive">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Fisrt Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Phone Number</th>
                            <th>Address</th>
                            <th>City</th>
                            <th>State</th>
                            <th>Zip Code</th>
                            <th>Notes</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($customers as $idx => $data)
                            <tr>
                                <td>
                                    <div class="d-flex px-2 py-1">
                                        {{ $idx + 1 . '. ' }}
                                    </div>
                                </td>
                                <td>
                                    {{ $data->first_name }}
                                </td>
                                <td>
                                    {{ $data->last_name }}
                                </td>
                                <td>
                                    {{ $data->email }}
                                </td>
                                <td>
                                    {{ $data->phone_number }}
                                </td>

                                @if (strlen($data->address) > 5)
                                    <td data-bs-toggle="tooltip" data-bs-placement="right"
                                        data-bs-custom-class="custom-tooltip" title="{{ $data->address }}"
                                        style="cursor: help">
                                        {{ substr($data->address, 0, 5) . '...' }}
                                    </td>
                                @else
                                    <td>{{ $data->address }}</td>
                                @endif

                                <td>
                                    {{ $data->city }}
                                </td>
                                <td>
                                    {{ $data->state }}
                                </td>
                                <td>
                                    {{ $data->zip }}
                                </td>
                                
                                @if (strlen($data->notes) > 5)
                                    <td data-bs-toggle="tooltip" data-bs-placement="right"
                                        data-bs-custom-class="custom-tooltip" title="{{ $data->notes }}"
                                        style="cursor: help">
                                        {{ substr($data->notes, 0, 5) . '...' }}
                                    </td>
                                @else
                                    <td>{{ $data->notes }}</td>
                                @endif

                                <td>
                                    <div class="d-flex align-items-center">
                                        <div>
                                            <a href="{{ route('customer.edit', $data->id) }}"
                                                class="btn btn-datatable btn-icon btn-transparent-dark me-2"><i
                                                    data-feather="edit" style="color: blue"></i></a>
                                        </div>
                                        <form action="{{ route('customer.destroy', $data->id) }}" method="post">
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
