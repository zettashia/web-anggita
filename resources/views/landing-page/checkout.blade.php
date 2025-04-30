@extends('landing-page.landing.main')
@section('content')
    <div class="checkout-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="coupon-accordion">
                        @if (session('discountResponse'))
                            @php
                                $response = session('discountResponse');
                            @endphp
                            @if ($response['status'])
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {!! $response['discountString'] !!}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @else
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    {!! $response['message'] !!}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                        @endif
                        <h3><span id="showcoupon">Click here to get Discount with Coupon</span></h3>
                        <div id="checkout_coupon" class="coupon-checkout-content">
                            <div class="coupon-info">
                                <form action="{{ route('applyDiscount') }}" method="POST">
                                    @csrf
                                    <p class="checkout-coupon">
                                        <input id="coupon_code" class="inputapplyDiscount-text" name="code"
                                            value="" placeholder="Coupon code" type="text">
                                        <input class="coupon-inner_btn button mt-xxs-30" name="apply_coupon"
                                            value="Apply coupon" type="submit">
                                    </p>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <form action="{{ route('saveCustomer') }}" method="POST">
                        @csrf
                        <div class="checkbox-form">
                            <h3>Billing Details</h3>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="checkout-form-list">
                                        <label>First Name <span class="required">*</span></label>
                                        <input placeholder="" type="text" name="first_name"
                                            value="{{ !empty($customer) ? $customer->first_name : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="checkout-form-list">
                                        <label>Last Name <span class="required">*</span></label>
                                        <input placeholder="" type="text" name="last_name"
                                            value="{{ !empty($customer) ? $customer->last_name : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="checkout-form-list">
                                        <label>Email Address <span class="required">*</span></label>
                                        <input placeholder="" type="email" name="email"
                                            value="{{ !empty($customer) ? $customer->email : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="checkout-form-list">
                                        <label>Phone <span class="required">*</span></label>
                                        <input type="text" name="phone_number"
                                            value="{{ !empty($customer) ? $customer->phone_number : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="checkout-form-list">
                                        <label>Address <span class="required">*</span></label>
                                        <input placeholder="Street address" type="text" name="address"
                                            value="{{ !empty($customer) ? $customer->address : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="checkout-form-list">
                                        <label>Town / City <span class="required">*</span></label>
                                        <input type="text" name="city"
                                            value="{{ !empty($customer) ? $customer->city : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="checkout-form-list">
                                        <label>State <span class="required">*</span></label>
                                        <input placeholder="" type="text" name="state"
                                            value="{{ !empty($customer) ? $customer->state : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="checkout-form-list">
                                        <label>Postcode / Zip <span class="required">*</span></label>
                                        <input placeholder="" type="text" name="zip"
                                            value="{{ !empty($customer) ? $customer->zip : '' }}">
                                    </div>
                                </div>
                                <div class="order-notes">
                                    <div class="checkout-form-list checkout-form-list-2">
                                        <label>Order Notes</label>
                                        <textarea id="checkout-mess" cols="30" rows="10" name="notes"
                                            placeholder="Notes about your order, e.g. special notes for delivery.">{{ !empty($customer) ? $customer->notes : '' }}</textarea>
                                    </div>
                                </div>
                                <div class="order-button-customer">
                                    <input value="Save Customer Address" type="submit">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-12">
                    <form action="{{ route('proccesCheckout') }}" method="POST">
                        @csrf
                        <div class="your-order">
                            <h3>Your order</h3>
                            <div class="your-order-table table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="cart-product-name">Product</th>
                                            <th class="cart-product-total">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($cartItems as $item)
                                            <tr class="cart-item">
                                                <td class="cart-product-name">{{ $item->name }}<strong
                                                        class="product-quantity">
                                                        x {{ $item->qty }}</strong></td>
                                                <td class="cart-product-total"><span class="amount">Rp
                                                        {{ number_format($item->price * $item->qty, 0, ',', '.') }}</span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        @if (session('discountResponse') && session('discountResponse')['status'])
                                            @php
                                                $discount = session('discountResponse')['discount'];
                                                $grandTotal = session('discountResponse')['grandTotal'];
                                            @endphp
                                            <tr class="cart-subtotal">
                                                <th>Cart Subtotal</th>
                                                <td><span class="amount">Rp
                                                        {{ Cart::subtotal(0, ',', '.') }}</span></td>
                                            </tr>
                                            <tr class="cart-subtotal">
                                                <th>Discount</th>
                                                <td><input type="hidden" name="discount" value="{{ $discount }}">
                                                    <span class="amount">- Rp
                                                        {{ number_format($discount, 0, ',', '.') }}</span></td>
                                            </tr>
                                            <tr class="order-total">
                                                <th>Order Total</th>
                                                <td><input type="hidden" name="total_amount" value="{{ $grandTotal }}">
                                                    <strong><span class="amount">Rp
                                                            {{ number_format($grandTotal, 0, ',', '.') }}</span></strong>
                                                </td>
                                            </tr>
                                        @else
                                            <tr class="cart-subtotal">
                                                <th>Cart Subtotal</th>
                                                <td><span class="amount">Rp
                                                        {{ Cart::subtotal(0, ',', '.') }}</span></td>
                                            </tr>
                                        @endif
                                    </tfoot>
                                </table>
                            </div>
                            <div class="payment-method">
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <div class="payment-accordion">
                                    <div id="accordion">
                                        <div class="card">
                                            <div class="card-header" id="payment-1">
                                                <h5 class="panel-title">
                                                    <label>
                                                        <input type="radio" name="payment_method" value="transfer" />
                                                        Direct Bank Transfer
                                                    </label>
                                                </h5>
                                            </div>
                                            <div id="collapseOne" class="collapse">
                                                <div class="card-body">
                                                    <div class="mb-3 ms-3">
                                                        <label for="bank-name" class="form-label">Bank Name</label>
                                                        <select class="form-control" name="bank_name">
                                                            <option selected value="">Select Bank</option>
                                                            <option value="BRI">BRI</option>
                                                            <option value="BCA">BCA</option>
                                                            <option value="BSI">BSI</option>
                                                            <option value="Mandiri">Mandiri</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="mb-3 ms-3">
                                                    <label for="account-number">Account Number</label>
                                                    <input type="number" id="card_number" name="card_number"
                                                        class="form-control" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header" id="payment-2">
                                            <h5 class="panel-title">
                                                <label>
                                                    <input type="radio" name="payment_method" value="cod" />
                                                    COD
                                                </label>
                                            </h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="order-button-payment">
                                    <input value="Place order" type="submit">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const paymentMethodInputs = document.querySelectorAll('input[name="payment_method"]');
            const collapseOne = document.getElementById('collapseOne');
            const bankNameInput = document.querySelector('select[name="bank_name"]');
            const cardNumberInput = document.getElementById('card_number');

            paymentMethodInputs.forEach(input => {
                input.addEventListener('change', function() {
                    if (this.value === 'transfer') {
                        collapseOne.classList.add('show');
                        bankNameInput.setAttribute('required', 'required');
                        cardNumberInput.setAttribute('required', 'required');
                    } else {
                        collapseOne.classList.remove('show');
                        bankNameInput.removeAttribute('required');
                        cardNumberInput.removeAttribute('required');
                    }
                });
            });
        });
    </script>
@endsection
