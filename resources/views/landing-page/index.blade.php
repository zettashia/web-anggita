@extends('landing-page.landing.main')
@section('content')

<style>
    .action_links {
    position: absolute;
    bottom: 12px;
    left: 0;
    right: 0;
    opacity: 0;
    visibility: hidden;
    transition: 0.3s;
    text-align: center; /* Pusatkan tautan aksi */
}

.action_links ul {
    list-style-type: none;
    padding: 0;
    margin: 0;
}

.action_links ul li {
    display: inline-block;
    margin-right: 3px;
}

.action_links ul li:last-child {
    margin-right: 0;
}

.action_links ul li button,
.action_links ul li a {
    font-family: 'Pe-icon-7-stroke';
    speak: none;
    font-style: normal;
    font-weight: normal;
    font-variant: normal;
    text-transform: none;
    line-height: 1;
    font-size: 24px;
    color: #ffffff;
    width: 40px;
    height: 40px;
    line-height: 40px;
    text-align: center;
    background: #222;
    display: inline-block;
    border-radius: 6px;
    transition: background 0.3s;
}

.action_links ul li button:hover,
.action_links ul li a:hover {
    background: #717fe0;
}

</style>
    <!--slide banner section start-->
    <div class="hero_banner_section hero_banner2 d-flex align-items-center mb-60" data-bgimg="{{ asset('assets/img/slide-01.jpg')}}">
        <div class="container">
            <div class="hero_banner_inner">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="hero_content hero_content2">
                            <h3 class="wow fadeInUp text-grey" data-wow-delay="0.1s" data-wow-duration="1.1s"> New Collection </h3>
                            <h1 class="wow fadeInUp text-grey" data-wow-delay="0.2s" data-wow-duration="1.2s">New Arrivals</h1>
                            <a class="btn btn-link wow fadeInUp" data-wow-delay="0.3s" data-wow-duration="1.3s"
                                href="{{ route('shop') }}">Shop Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--slider area end-->

    <!-- featured banner section start -->
    <div class="featured_banner_section mb-100">
        <div class="container-fluid">
            <div class="section_title text-center mb-55">
                <h2>Categories Products</h2>
            </div>
            <div class="row featured_banner_inner slick__activation"
                data-slick='{
        "slidesToShow": 3,
        "slidesToScroll": 1,
        "arrows": true,
        "dots": false,
        "autoplay": false,
        "speed": 300,
        "infinite": true ,
        "responsive":[
          {"breakpoint":768, "settings": { "slidesToShow": 2 } },
          {"breakpoint":500, "settings": { "slidesToShow": 1 } }
         ]
    }'>
                @foreach ($productCategories as $pc)
                
                    <div class="col-lg-4">
                        
                        <div class="single_featured_banner wow fadeInUp" data-wow-delay="0.1s" data-wow-duration="1.1s">

                            <div class="featured_banner_thumb">
                            <h3><a href="{{ route('shop', $pc->slug) }}">{{ $pc->category_name }}</a></h3>

                                <a href="{{ route('shop', $pc->slug) }}"><img src="{{ asset('storage/' . $pc->image_url) }}"
                                        alt=""></a>

                            </div>
                            <!-- <div class="featured_banner_text d-flex justify-content-between align-items-center"> -->
                                <!-- <span>({{ $pc->products_count }})</span> -->
                            <!-- </div> -->
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- featured banner section end -->

    <!-- product section start -->
    <div class="product_section mb-80 wow fadeInUp" data-wow-delay="0.1s" data-wow-duration="1.1s">
        <div class="container">
            <div class="product_header">
                <div class="section_title text-center">
                    <h2>New Collection</h2>
                </div>
                <div class="product_tab_button">
                    <ul class="nav justify-content-center" role="tablist" id="nav-tab">
                        <!-- <li>
                            <a class="active" data-toggle="tab" href="#features" role="tab" aria-controls="features"
                                aria-selected="false">Our Features </a>
                        </li> -->
                    </ul>
                </div>
            </div>
            <div class="tab-content product_container">
                <div class="tab-pane fade show active" id="features" role="tabpanel">
                    <div class="product_gallery">
                        <div class="row">
                            @foreach ($products as $product)
                            <div class="col-lg-3 col-md-4 col-sm-6">
    <article class="single_product">
        <figure>
            <div class="product_thumb">
                <a href="{{ route('product.detail', $product->slug) }}">
                    <img src="{{ asset('storage/' . $product->image1_url) }}" alt="">
                </a>
                <div class="action_links">
                    <ul class="d-flex justify-content-center">
                        <li class="wishlist">
                            <form action="{{ route('addWishlist') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id" value="{{ $product->id }}">
                                <button type="submit" title="Add to Wishlist">
                                    <span class="pe-7s-like"></span> <!-- Icon untuk wishlist -->
                                </button>
                            </form>
                        </li>
                        <li class="quick_button">
                            <a href="#" title="Quick View" data-bs-toggle="modal" data-bs-target="#modal_box_{{ $product->id }}">
                                <span class="pe-7s-look"></span> <!-- Icon untuk quick view -->
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <figcaption class="product_content text-center">
                <h4><a href="{{ route('product.detail', $product->slug) }}">{{ $product->product_name }}</a></h4>
                <div class="price_box">
                    <span class="current_price">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                </div>
                                <!-- Alert untuk menampilkan pesan berhasil ditambahkan ke wishlist -->
                                <div class="alert alert-success alert-dismissible fade show mt-3" role="alert" style="display: none;">
                    Product added to wishlist!
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>

            </figcaption>
        </figure>
    </article>
</div>
                            @endforeach
                            @foreach ($products as $product)
                                @include('landing-page.landing.modal', ['product' => $product])
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- banner fullwidth section start -->
    <!-- <div class="deals_banner_section padding-l-r-92 mb-105 wow fadeInUp" data-wow-delay="0.1s" data-wow-duration="1.1s">
        <div class="deals_banner_bg" data-bgimg="{{ asset('assets/img/slide-02.jpg')}}">
            <div class="container">
                <div class="deals_banner_inner">
                    <div class="row">
                        <div class="col-lg-6 offset-lg-6 col-md-6 offset-md-6">
                            <div class="banner_discount_text deals_banner_text ">
                                <h3><span>30% </span> Sale Off</h3>
                                <h2>Grand Opening Git Shop</h2>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do
                                    eiusmod <br> tempor
                                    incididunt ut labore et dolore magna</p>
                                <div class="timer__area">
                                    <div data-countdown="2023/10/11"></div>
                                </div>
                                <a class="btn btn-link" href="{{ route('shop') }}">Shop Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
    <!-- banner fullwidth section end -->

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const wishlistForms = document.querySelectorAll('.wishlist-form');
            wishlistForms.forEach(form => {
                form.addEventListener('submit', function (event) {
                    event.preventDefault();
                    const productId = this.querySelector('input[name="id"]').value;
                    const alertBox = this.closest('.single_product').querySelector('.alert');
                    
                    // Simulasi request ke server (atau ganti dengan AJAX jika diperlukan)
                    setTimeout(() => {
                        alertBox.style.display = 'block';
                        setTimeout(() => {
                            alertBox.style.display = 'none';
                        }, 3000); // Sembunyikan alert setelah 3 detik
                    }, 500); // Contoh penundaan 500ms, bisa diganti dengan penanganan AJAX sebenarnya
                });
            });
        });
    </script>

@endsection

