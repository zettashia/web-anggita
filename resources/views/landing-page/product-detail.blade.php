@extends('landing-page.landing.main')
@section('content')
    <!-- breadcrumbs area start -->
    <!-- breadcrumbs area end -->

    <!-- single product section start-->
    <div class="single_product_section mb-100">
        <div class="container">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {!! session('success') !!}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="single_product_gallery">
                        <div class="product_gallery_inner d-flex">
                            <div class="product_gallery_main_img">
                                <div class="gallery_img_list">
                                    <img data-image="{{ asset('storage/' . $productDetails->image1_url) }}"
                                        src="{{ asset('storage/' . $productDetails->image1_url) }}" alt="">
                                </div>
                                <div class="gallery_img_list">
                                    <img src="{{ asset('storage/' . $productDetails->image2_url) }}" alt="">
                                </div>
                                <div class="gallery_img_list">
                                    <img src="{{ asset('storage/' . $productDetails->image3_url) }}" alt="">
                                </div>
                                <div class="gallery_img_list">
                                    <img src="{{ asset('storage/' . $productDetails->image4_url) }}" alt="">
                                </div>
                                <div class="gallery_img_list">
                                    <img src="{{ asset('storage/' . $productDetails->image5_url) }}" alt="">
                                </div>
                            </div>
                            <div class="product_gallery_btn_img">
                                <a class="gallery_btn_img_list" href="javascript:void(0)"><img
                                        src="{{ asset('storage/' . $productDetails->image1_url) }}" alt="tab-thumb"></a>
                                <a class="gallery_btn_img_list" href="javascript:void(0)"><img
                                        src="{{ asset('storage/' . $productDetails->image2_url) }}" alt="tab-thumb"></a>
                                <a class="gallery_btn_img_list" href="javascript:void(0)"><img
                                        src="{{ asset('storage/' . $productDetails->image3_url) }}" alt="tab-thumb"></a>
                                <a class="gallery_btn_img_list" href="javascript:void(0)"><img
                                        src="{{ asset('storage/' . $productDetails->image4_url) }}" alt="tab-thumb"></a>
                                <a class="gallery_btn_img_list" href="javascript:void(0)"><img
                                        src="{{ asset('storage/' . $productDetails->image5_url) }}" alt="tab-thumb"></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="product_details_sidebar">
                        <h2 class="product__title">{{ $productDetails->product_name }}</h2>
                        <div class="price_box">
                            <span class="new_price">Rp {{ number_format($productDetails->price, 0, ',', '.') }}</span>
                        </div>
                        <div class="quickview__info mb-0">
                            <p class="product_review d-flex align-items-center">
                                <span class="review_icon d-flex">
                                    <i class="ion-ios-star"></i>
                                    <i class="ion-ios-star"></i>
                                    <i class="ion-ios-star"></i>
                                    <i class="ion-ios-star"></i>
                                    <i class="ion-ios-star"></i>
                                </span>
                                <span class="review__text"> (5 reviews)</span>
                            </p>
                        </div>
                        <p class="product_details_desc">{{ $productDetails->description }}</p>
                        <div class="product_pro_button quantity d-flex align-items-center">
                            <div class="pro-qty border">
                                <input type="text" value="1">
                            </div>
                            <form action="{{ route('addCart') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id" value="{{ $productDetails->id }}">
                                <button class="add_to_cart " type="submit">add to cart</button>
                            </form>
                            <form action="{{route('addWishlist')}}" method="POST">
                                @csrf
                                <input type="hidden" name="id" value="{{ $productDetails->id }}">
                                <button class="wishlist__btn" type="submit"><i class="pe-7s-like" style="font-size: 20px"></i></button>
                            </form>
                        </div>
                        <!-- <div class="product_paypal">
                            <img src="{{ asset('assets/img/others/paypal.webp') }}" style="width: 30%" alt="payments">
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- product details section end-->

    <!-- product tab section start -->
    <div class="product_tab_section mb-80">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="product_tab_navigation">
                        <ul class="nav justify-content-center">
                            <li>
                                <a class="active" data-bs-toggle="tab" href="#description" aria-controls="description">Description</a>
                            </li>
                            <li>
                                <a data-bs-toggle="tab" href="#reviews" aria-controls="reviews">Reviews</a>
                            </li>
                        </ul>
                    </div>
                    <div class="product_page_content_inner tab-content">
                        <div class="tab-pane fade show active" id="description" role="tabpanel">
                            <div class="product_tab_desc">
                                <p>{{ $productDetails->description }}</p>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="reviews" role="tabpanel">
                            <div class="reviews__wrapper">
                                <h2>Write Your Own Review</h2>
                                <div class="customer__reviews d-flex justify-content-between mb-20">
                                    <div class="customer_reviews_left">
                                        <div class="comment__title">
                                            <h2>Add a review</h2>
                                            <p>Your email address will not be published. Required fields are marked</p>
                                        </div>
                                        <div class="reviews__ratting">
                                            <h3>Your rating</h3>
                                            <ul class="d-flex">
                                                <li><a href="#"><i class="ion-ios-star"></i></a></li>
                                                <li><a href="#"><i class="ion-ios-star"></i></a></li>
                                                <li><a href="#"><i class="ion-ios-star"></i></a></li>
                                                <li><a href="#"><i class="ion-ios-star"></i></a></li>
                                                <li><a href="#"><i class="ion-ios-star"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="customer_reviews_right">
                                        <h2 class="reviews__title">Customer Reviews</h2>
                                        @foreach ($reviews as $review)
                                        <div class="reviews__ratting">
                                            <ul class="d-flex">
                                                @for ($i = 0; $i < $review->rating; $i++)
                                                    <li><a href="#"><i class="ion-ios-star"></i></a></li>
                                                @endfor
                                                @for ($i = $review->rating; $i < 5; $i++)
                                                    <li><a href="#"><i class="ion-ios-star-outline"></i></a></li>
                                                @endfor
                                            </ul>
                                        </div>
                                        <div class="reviews__desc">
                                            <h3>{{ $review->comment }}</h3>
                                            <span>Reviewed on {{ $review->created_at->format('F d, Y') }}</span>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>

                                <div class="product_review_form">
                                    <form action="{{ route('product.review', $productDetails->id) }}" method="POST">
                                        @csrf
                                        <div class="row">
                                            <div class="col-12">
                                                <label for="review_comment">Your review </label>
                                                <textarea class="border" name="comment" id="review_comment"></textarea>
                                            </div>
                                            <div class="col-lg-6 col-md-6">
                                                <label for="author">Name</label>
                                                <input class="border" id="author" type="text" name="author" value="{{ Auth::user()->name }}" readonly>
                                            </div>
                                            <div class="col-lg-6 col-md-6">
                                                <label for="email">Email </label>
                                                <input class="border" id="email" type="text" name="email" value="{{ Auth::user()->email }}" readonly>
                                            </div>
                                            <div class="col-12">
                                                <label for="rating">Rating</label>
                                                <select name="rating" id="rating" class="border">
                                                    <option value="1">1 Star</option>
                                                    <option value="2">2 Stars</option>
                                                    <option value="3">3 Stars</option>
                                                    <option value="4">4 Stars</option>
                                                    <option value="5">5 Stars</option>
                                                </select>
                                            </div>
                                        </div>
                                        <button class="btn custom-btn text-white" data-hover="Submit" type="submit">Submit</button>
                                    </form>
                                </div>
                                @if($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                @if(session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- product tab section end -->
@endsection
