<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="icon" type="image/png" href="{{ asset('assetss/images/favicon2.png') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assetss/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assetss/css/fontawesome-all.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assetss/css/iofrm-style.css') }}">
    <!-- <link rel="stylesheet" type="text/css" href="{{ asset('assetss/css/iofrm-theme7.css') }}"> -->
</head>

<body>
    <div class="form-body" class="container-fluid">
        <div class="website-logo">
            <a href="{{ route('home') }}">
                <!-- <div class="logo">
                    <img class="logo-size" src="{{ asset('assetss/images/favicon1.png') }}" alt="">
                </div> -->
            </a>
        </div>
        <div class="row">
            <div class="img-holder">
                <div class="bg"></div>
                <!-- <div class="info-holder">
                    <img src="{{ asset('assetss/images/graphic3.svg') }}" alt="">
                </div> -->
            </div>
            <div class="form-holder">
                <div class="form-content">
                    <div class="form-items">
                        <h3>Login Account</h3>
                        <!-- <p>Access to the most powerfull tool in the entire design and web industry.</p> -->
                        @if (Session::has('success'))
                            <div class="col-md-12">
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ Session::get('success') }}
                                  </div>
                            </div>
                        @endif
                        @if (Session::has('error'))
                            <div class="col-md-12">
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    {{ Session::get('error') }}
                                  </div>
                            </div>
                        @endif
                        <div class="page-links">
                            <a href="{{route('account.login')}}" class="active">Login</a><a href="{{route('account.register')}}">Register</a>
                        </div>
                        <form action="{{ route('account.auth') }}" method="POST">
                            @csrf
                            <input class="form-control  @error('email') is-invalid @enderror" id="inputEmailAddress"
                                type="email" placeholder="Enter email address" value="{{ old('email') }}"
                                name="email" />
                            <input class="form-control @error('password') is-invalid @enderror" id="inputPassword"
                                type="password" placeholder="Enter password" name="password" />
                            <div class="form-button">
                                <button id="submit" type="submit" class="ibtn">Login</button>
                            </div>
                        </form>
                        <!-- <div class="other-links">
                            <span>Or login with</span>
                            <a href="#"><i class="fab fa-google"></i></a>
                            <a href="#"><i class="fab fa-facebook-f"></i></a>
                            <a href="#"><i class="fab fa-twitter"></i></a>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="{{ asset('assetss/js/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assetss/js/popper.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assetss/js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assetss/js/main.js') }}"></script>
</body>

</html>
