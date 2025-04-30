@extends('landing-page.landing.main')
@section('content')
    <div class="cart-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <form action="#">
                        <div class="table-content table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="product_remove">remove</th>
                                        <th class="product-thumbnail">images</th>
                                        <th class="cart-product-name">Product</th>
                                        <th class="product-price">Unit Price</th>
                                        <th class="product-quantity">Quantity</th>
                                        <th class="product-subtotal">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($cartCount > 0)
                                        @foreach ($cartItems as $item)
                                            <tr>
                                                <td class="product_remove">
                                                    <form action="{{ route('deleteCart') }}" method="POST"
                                                        onsubmit="return confirm('Are you sure want to delete this item?')"
                                                        id="deleteForm">

                                                    </form>
                                                    <form action="{{ route('deleteCart') }}" method="POST"
                                                        onsubmit="return confirm('Are you sure want to delete this item?')"
                                                        id="deleteForm">
                                                        @csrf
                                                        <input type="hidden" name="rowId" value="{{ $item->rowId }}">
                                                        <button type="submit">
                                                            <i class="pe-7s-close" title="Remove"></i>
                                                        </button>
                                                    </form>
                                                    {{-- Cart Update --}}
                                                    <form id="updateCartForm" method="POST"
                                                        action="{{ route('updateCart') }}" style="display: none;">
                                                        @csrf
                                                        <input type="hidden" name="rowId" id="cartRowId"
                                                            value="{{ $item->rowId }}">
                                                        <input type="hidden" name="qty" id="cartQty">
                                                    </form>
                                                    {{-- End Cart Update --}}
                                                </td>
                                                <td class="product-thumbnail" style="width : 10%; height : auto">
                                                    <a href="#">
                                                        <img src="{{ asset('storage/' . $item->options->image) }}"
                                                            alt="Cart Thumbnail">
                                                    </a>
                                                </td>
                                                <td class="product-name"><a href="#">{{ $item->name }}</a>
                                                </td>
                                                <td class="product-price"><span class="amount">Rp
                                                        {{ number_format($item->price, 0, ',', '.') }}</span></td>
                                                <td class="product_pro_button quantity">
                                                    <div class="pro-qty border">
                                                        <button class="dec qty-btn" data-id="{{ $item->rowId }}"
                                                            id="sub">-</button>
                                                        <input  type="text" value="{{ $item->qty }}">
                                                        <button class="inc qty-btn" data-id="{{ $item->rowId }}"
                                                            id="add">+</button>
                                                    </div>
                                                </td>
                                                <td class="product-subtotal"><span class="amount">Rp
                                                        {{ number_format($item->price * $item->qty, 0, ',', '.') }} </span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="6">Cart is empty</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-md-5 ml-auto">
                                <div class="cart-page-total">
                                    <h2>Cart totals</h2>
                                    @if (session('discountResponse') && session('discountResponse')['status'])
                                        @php
                                            $discount = session('discountResponse')['discount'];
                                            $grandTotal = session('discountResponse')['grandTotal'];
                                        @endphp
                                        <ul>
                                            <li>
                                                <div
                                                    class="py-4 mb-4 border-top border-bottom d-flex justify-content-between">
                                                    <h5 class="mb-0 ps-4 me-4">Subtotal</h5>
                                                    <p class="mb-0 pe-4">Rp
                                                        {{ Cart::subtotal(0, ',', '.') }}</p>
                                                </div>
                                            </li>
                                            <li>
                                                <div
                                                    class="py-4 mb-4 border-top border-bottom d-flex justify-content-between">
                                                    <h5 class="mb-0 ps-4 me-4">Discount</h5>
                                                    <p class="mb-0 pe-4">- Rp {{ number_format($discount, 0, ',', '.') }}
                                                    </p>
                                                </div>
                                            </li>
                                            <li>
                                                <div
                                                    class="py-4 mb-4 border-top border-bottom d-flex justify-content-between">
                                                    <h5 class="mb-0 ps-4 me-4">Total</h5>
                                                    <p class="mb-0 pe-4">Rp {{ number_format($grandTotal, 0, ',', '.') }}
                                                    </p>
                                                </div>
                                            </li>
                                        </ul>
                                    @else
                                        <ul>
                                            <li>
                                                <div
                                                    class="py-4 mb-4 border-top border-bottom d-flex justify-content-between">
                                                    <h5 class="mb-0 ps-4 me-4">Total</h5>
                                                    <p class="mb-0 pe-4">Rp
                                                        {{Cart::subtotal(0, ',', '.')}}</p>
                                                </div>
                                            </li>
                                        </ul>
                                    @endif
                                    <a href="{{ route('checkout') }}">Proceed to checkout</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
