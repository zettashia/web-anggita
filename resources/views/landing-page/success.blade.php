@extends('landing-page.landing.main')
@section('content')
<!-- Begin Error 404 Area -->
<div class="success-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="success-content">
                    <h1 class="title mb-4">ORDER COMPLETED!</h1>
                    <div class="button-wrap">
                        <a class="btn btn-success btn-lg rounded-0" href="{{ route('account.orders') }}">Back to home</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Error 404 Area End Here -->
@endsection
