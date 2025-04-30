@extends('landing-page.landing.main')
@section('content')
    <div class="account-page-area">
        <div class="container">
            <div class="row">
                @include('landing-page.account.layout.sidebar')
                <div class="col-lg-9">
                    <div class="tab-pane fade show active" id="account-orders" role="tabpanel" aria-labelledby="account-orders-tab">
                        <div class="myaccount-orders">
                            <!-- <h4 class="small-title">MY ORDERS</h4> -->
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <tbody>
                                        <tr>
                                            <th>ORDER</th>
                                            <th>DATE</th>
                                            <th>STATUS</th>
                                            <th>TOTAL</th>
                                            <th></th>
                                        </tr>

                                        @foreach ($orders as $order)
                                            <tr>
                                                <td><a class="account-order-id"
                                                        href="javascript:void(0)">{{ !empty($order) ? $order->order_no : '' }}</a>
                                                </td>
                                                <td>{{ !empty($order) ? $order->order_date : '' }}</td>
                                                <td><span class="@if ($order->status == 'pending')
                                                    badge bg-secondary
                                                @elseif ($order->status == 'shipped')
                                                    badge bg-secondary
                                                @elseif ($order->status == 'delivered')
                                                    badge bg-secondary
                                                @else
                                                    badge bg-secondary
                                                @endif">
                                                    {{ !empty($order) ? $order->status : '' }}
                                                </span></td>
                                                {{-- <td>{{ !empty($order) ? $order->status : '' }}</td> --}}
                                                <td>Rp{{ number_format(!empty($order) ? $order->total_amount : '', 0, ',', '.') }}</td>
                                                <td><a href="{{ route('account.orderDetail', $order->id) }}"
                                                        class="btn btn-secondary btn-primary-hover"><span>View</span></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


