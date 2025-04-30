<!-- Modal -->
<div class="modal fade" id="modal_box_{{ $product->id }}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true"><i class="ion-android-close"></i></span>
            </button>
            <div class="modal_body">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-5 col-md-5 col-sm-12">
                            <div class="modal_tab">
                                <div class="tab-content product-details-large">
                                    <div class="tab-pane fade show active" id="tab1_{{ $product->id }}" role="tabpanel">
                                        <div class="modal_tab_img">
                                            <a href="{{ route('product.detail', $product->slug) }}">
                                                <img src="{{ asset('storage/' . $product->image1_url) }}" alt="">
                                            </a>
                                        </div>
                                    </div>
                                    @if ($product->image2_url)
                                    <div class="tab-pane fade" id="tab2_{{ $product->id }}" role="tabpanel">
                                        <div class="modal_tab_img">
                                            <a href="{{ route('product.detail', $product->slug) }}">
                                                <img src="{{ asset('storage/' . $product->image2_url) }}" alt="">
                                            </a>
                                        </div>
                                    </div>
                                    @endif
                                    @if ($product->image3_url)
                                    <div class="tab-pane fade" id="tab3_{{ $product->id }}" role="tabpanel">
                                        <div class="modal_tab_img">
                                            <a href="{{ route('product.detail', $product->slug) }}">
                                                <img src="{{ asset('storage/' . $product->image3_url) }}" alt="">
                                            </a>
                                        </div>
                                    </div>
                                    @endif
                                    @if ($product->image4_url)
                                    <div class="tab-pane fade" id="tab4_{{ $product->id }}" role="tabpanel">
                                        <div class="modal_tab_img">
                                            <a href="{{ route('product.detail', $product->slug) }}">
                                                <img src="{{ asset('storage/' . $product->image4_url) }}" alt="">
                                            </a>
                                        </div>
                                    </div>
                                    @endif
                                    @if ($product->image5_url)
                                    <div class="tab-pane fade" id="tab5_{{ $product->id }}" role="tabpanel">
                                        <div class="modal_tab_img">
                                            <a href="{{ route('product.detail', $product->slug) }}">
                                                <img src="{{ asset('storage/' . $product->image5_url) }}" alt="">
                                            </a>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                                <div class="modal_tab_button">
                                    <ul class="nav product_navactive owl-carousel" role="tablist">
                                        <li>
                                            <a class="nav-link active" data-toggle="tab" href="#tab1_{{ $product->id }}" role="tab" aria-controls="tab1_{{ $product->id }}" aria-selected="true">
                                                <img src="{{ asset('storage/' . $product->image1_url) }}" alt="">
                                            </a>
                                        </li>
                                        @if ($product->image2_url)
                                        <li>
                                            <a class="nav-link" data-toggle="tab" href="#tab2_{{ $product->id }}" role="tab" aria-controls="tab2_{{ $product->id }}" aria-selected="false">
                                                <img src="{{ asset('storage/' . $product->image2_url) }}" alt="">
                                            </a>
                                        </li>
                                        @endif
                                        @if ($product->image3_url)
                                        <li>
                                            <a class="nav-link" data-toggle="tab" href="#tab3_{{ $product->id }}" role="tab" aria-controls="tab3_{{ $product->id }}" aria-selected="false">
                                                <img src="{{ asset('storage/' . $product->image3_url) }}" alt="">
                                            </a>
                                        </li>
                                        @endif
                                        @if ($product->image4_url)
                                        <li>
                                            <a class="nav-link" data-toggle="tab" href="#tab4_{{ $product->id }}" role="tab" aria-controls="tab4_{{ $product->id }}" aria-selected="false">
                                                <img src="{{ asset('storage/' . $product->image4_url) }}" alt="">
                                            </a>
                                        </li>
                                        @endif
                                        @if ($product->image5_url)
                                        <li>
                                            <a class="nav-link" data-toggle="tab" href="#tab5_{{ $product->id }}" role="tab" aria-controls="tab5_{{ $product->id }}" aria-selected="false">
                                                <img src="{{ asset('storage/' . $product->image5_url) }}" alt="">
                                            </a>
                                        </li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-7 col-md-7 col-sm-12">
                            <div class="modal_right">
                                <div class="modal_title mb-10">
                                    <h2>{{ $product->product_name }}</h2>
                                </div>
                                <div class="modal_price mb-10">
                                    <span class="new_price">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                                </div>
                                <div class="modal_description mb-15">
                                    <p>{{ $product->description }}</p>
                                </div>
                                <div class="variants_selects">
                                    <div class="variants_size">
                                        <h2>Stock</h2>
                                        <p>{{ $product->stok_quantity }}</p>
                                    </div>
                                    <div class="modal_add_to_cart">
                                        <form action="{{ route('addCart') }}" method="POST">
                                            @csrf
                                            <input value="{{ $product->id }}" type="hidden" name="id">
                                            <button type="submit">Add to cart</button>
                                        </form>
                                    </div>
                                </div>
                                <div class="modal_social">
                                    <h2>Share this product</h2>
                                    <ul>
                                        <li class="facebook"><a href="#"><i class="ion-social-facebook"></i></a></li>
                                        <li class="twitter"><a href="#"><i class="ion-social-twitter"></i></a></li>
                                        <li class="pinterest"><a href="#"><i class="ion-social-pinterest"></i></a></li>
                                        <li class="google-plus"><a href="#"><i class="ion-social-googleplus"></i></a></li>
                                        <li class="linkedin"><a href="#"><i class="ion-social-linkedin"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
