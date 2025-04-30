@extends('landing-page.landing.main')
@section('content')
    <!-- breadcrumbs area start -->
    <div class="breadcrumbs_aree breadcrumbs_bg mb-110" data-bgimg="{{ asset('assets/img/others/Breadcrumbs-bg_1920x503.png') }}">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumbs_text">
                        <h1>My Account</h1>
                        <ul>
                            <li><a href="{{ route('home') }}">Home </a></li>
                            <li> // My Account</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumbs area end -->
    <div class="account-page-area">
        <div class="container">
            <div class="row">
                @include('landing-page.account.layout.sidebar')
                <div class="col-lg-9">
                    <div class="tab-content myaccount-tab-content" id="account-page-tab-content">
                        <div class="tab-pane fade show active" id="account-address" role="tabpanel"
                            aria-labelledby="account-address-tab">
                            <div class="myaccount-address">
                                <form action="{{ route('saveCustomer') }}" class="myaccount-form" method="POST">
                                    @csrf
                                    <div class="myaccount-form-inner">
                                        <div class="single-input single-input-half">
                                            <label>First Name<span class="required">*</span></label>
                                            <input type="text" name="first_name"
                                                value="{{ !empty($customer) ? $customer->first_name : '' }}">
                                        </div>
                                        <div class="single-input single-input-half">
                                            <label>Last Name<span class="required">*</span></label>
                                            <input type="text" name="last_name"
                                                value="{{ !empty($customer) ? $customer->last_name : '' }}">
                                        </div>
                                        <div class="single-input single-input-half">
                                            <label>Email<span class="required">*</span></label>
                                            <input type="email" name="email"
                                                value="{{ !empty($customer) ? $customer->email : '' }}">
                                        </div>
                                        <div class="single-input single-input-half">
                                            <label>Phone<span class="required">*</span></label>
                                            <input type="number" name="phone_number"
                                                value="{{ !empty($customer) ? $customer->phone_number : '' }}">
                                        </div>
                                        <div class="single-input">
                                            <label>Address<span class="required">*</span></label>
                                            <input type="text" name="address"
                                                value="{{ !empty($customer) ? $customer->address : '' }}">
                                        </div>
                                        <div class="single-input">
                                            <label>Town/City<span class="required">*</span></label>
                                            <input type="text" name="city"
                                                value="{{ !empty($customer) ? $customer->city : '' }}">
                                        </div>
                                        <div class="single-input single-input-half">
                                            <label>State<span class="required">*</span></label>
                                            <input type="text" name="state"
                                                value="{{ !empty($customer) ? $customer->state : '' }}">
                                        </div>
                                        <div class="single-input single-input-half">
                                            <label>Postcode/Zip<span class="required">*</span></label>
                                            <input type="number" name="zip"
                                                value="{{ !empty($customer) ? $customer->zip : '' }}">
                                        </div>
                                        <div class="single-input">
                                            <button class="btn custom-btn" type="submit">
                                                <span>SAVE CHANGES</span>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>



                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
