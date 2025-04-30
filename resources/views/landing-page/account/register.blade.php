<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="icon" type="image/png" href="{{ asset('assetss/images/favicon2.png') }}">
    <link rel="stylesheet" type="text/css" href="{{asset('assetss/css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assetss/css/fontawesome-all.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assetss/css/iofrm-style.css')}}">
    <!-- <link rel="stylesheet" type="text/css" href="{{asset('assetss/css/iofrm-theme7.css')}}"> -->
</head>
<body>
    <div class="form-body" class="container-fluid">
        <div class="website-logo">
            <a href="{{ route('home') }}">
                <!-- <div class="logo">
                    <img class="logo-size" src="{{asset('assetss/images/logo-light.svg')}}" alt="">
                </div> -->
            </a>
        </div>
        <div class="row">
            <div class="img-holder">
                <div class="bg"></div>
                <!-- <div class="info-holder">
                    <img src="{{asset('assetss/images/graphic3.svg')}}" alt="">
                </div> -->
            </div>
            <div class="form-holder">
                <div class="form-content">
                    <div class="form-items">
                        <h3>Register Account</h3>
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
                            <a href="{{route('account.login')}}">Login</a><a href="{{route('account.register')}}" class="active">Register</a>
                        </div>
                        <form action="{{route('account.storeRegister')}}" method="POST">
                            @csrf
                            <input class="form-control" type="text" name="name" placeholder="Name" required>
                            <input class="form-control" type="email" name="email" placeholder="E-mail Address" required>
                            <input class="form-control" type="password" name="password" placeholder="Password" required>
                            <div class="form-button">
                                <button id="submit" type="submit" class="ibtn">Register</button>
                            </div>
                        </form>
                        <!-- <div class="other-links">
                            <span>Or register with</span><a href="#"><i class="fab fa-facebook-f"></i></a><a href="#"><i class="fab fa-google"></i></a><a href="#"><i class="fab fa-twitter"></i></a>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
<script type="text/javascript" src="{{asset('assetss/js/jquery.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assetss/js/popper.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assetss/js/bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assetss/js/main.js')}}"></script>
</body>
</html>
