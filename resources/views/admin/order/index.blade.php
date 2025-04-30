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
            <div class="card card-header-actions">
                <div class="card-header">
                    List Order
                    <a href="javascript:void(0);" class="btn btn-success" id="exportButton">Export PDF</a>
                </div>
            </div>
            <div class="card-body table-responsive">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Order Number</th>
                            <th>Name</th>
                            <th>Order Date</th>
                            <th>Product</th>
                            <th>Total Amount</th>
                            <th>Payment Method</th>
                            <th>Payment Status</th>
                            <th>Status</th>
                            <th>Delivery Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $idx => $data)
                            <tr>
                                <td>
                                    <div class="d-flex px-2 py-1">
                                        {{ $idx + 1 . '. ' }}
                                    </div>
                                </td>
                                <td>
                                    {{ $data->order_no }}
                                </td>
                                <td>
                                    {{ $data->first_name . ' ' . $data->last_name }}
                                </td>
                                <td>
                                    {{ $data->order_date }}
                                </td>
                                <td>
                                    <ul>
                                        @foreach ($data->items as $item)
                                            <li>{{ $item->product->product_name }} x {{ $item->quantity }}</li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td>
                                    Rp {{ number_format($data->total_amount, 0, ',', '.') }}
                                </td>
                                <td>
                                    {{ $data->payment_method }}
                                </td>
                                <td>
                                    <span
                                        class="{{ $data->payment_status == 'not_paid' ? 'badge bg-danger' : 'badge bg-success' }}">
                                        {{ $data->payment_status }}
                                    </span>
                                </td>
                                <td>
                                    <span
                                        class="@if ($data->status == 'pending') badge bg-secondary
                                    @elseif ($data->status == 'shipped')
                                        badge bg-secondary
                                    @elseif ($data->status == 'delivered')
                                        badge bg-secondary
                                    @else
                                        badge bg-secondary @endif">
                                        {{ $data->status }}
                                    </span>
                                </td>
                                <td>
                                    {{ $data->delivered_date }}
                                </td>
                                <td>
                                <div class="btn-group" role="group" aria-label="Order Actions">
                                        <form action="{{ route('order.edit', $data->id) }}" method="GET">
                                            @csrf
                                            <button type="submit" class="btn btn-info">
                                                <i class="fas fa-edit"></i> Edit
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.3.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.13/jspdf.plugin.autotable.min.js"></script>
    <script>
        document.getElementById('exportButton').addEventListener('click', function () {
            const { jsPDF } = window.jspdf;
            const doc = new jsPDF();

            // Mendapatkan data dari tabel
            const rows = Array.from(document.querySelectorAll('#datatablesSimple tbody tr')).map(row => {
                const columns = Array.from(row.querySelectorAll('td')).map(td => td.innerText.trim());
                // Menghapus kolom "Actions" (kolom terakhir)
                columns.pop();
                // Menggabungkan semua produk menjadi satu string
                if (columns[4].includes('\n')) {
                    columns[4] = columns[4].split('\n').map(product => product.trim()).join(', ');
                }
                return columns;
            });

            // Tambahkan header secara manual
            const header = Array.from(document.querySelectorAll('#datatablesSimple thead th')).map(th => th.innerText.trim());
            // Menghapus kolom "Actions" dari header
            header.pop();

            // Generate PDF
            doc.autoTable({
                head: [header],
                body: rows,
                headStyles: { fillColor: [0, 255, 0] },
                margin: { top: 10 },
                didDrawPage: function (data) {
                    doc.text('Order List', data.settings.margin.left, 10);
                }
            });

            // Simpan PDF
            doc.save('order-list.pdf');
        });
    </script>
@endsection
