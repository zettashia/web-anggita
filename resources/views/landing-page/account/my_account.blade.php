@extends('landing-page.landing.main')
@section('content')
    <!-- breadcrumbs area start -->
    <!-- <div class="breadcrumbs_aree breadcrumbs_bg mb-110" data-bgimg="{{ asset('assets/img/others/Breadcrumbs-bg_1920x503.png') }}">
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
    </div> -->
    <!-- breadcrumbs area end -->
    <div class="account-page-area">
        <div class="container">
            <div class="row">
                @include('landing-page.account.layout.sidebar')
                <div class="col-lg-9">
                    <div class="tab-content myaccount-tab-content" id="account-page-tab-content">
                        <div class="tab-pane fade show active" id="account-details" role="tabpanel"
                            aria-labelledby="account-details-tab">
                            <div class="myaccount-details">
                                <form action="{{ route('account.updateProfile') }}" class="myaccount-form" method="POST">
                                    @csrf
                                    <div class="myaccount-form-inner">
                                        <div class="single-input single-input-half">
                                            <label>Name<span class="required"></span></label>
                                            <input type="text" name="name"
                                                value="{{ !empty($user) ? $user->name : '' }}">
                                        </div>
                                        <div class="single-input">
                                            <label>Email<span class="required"></span></label>
                                            <input type="email" name="email"
                                                value="{{ !empty($user) ? $user->email : '' }}">
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
