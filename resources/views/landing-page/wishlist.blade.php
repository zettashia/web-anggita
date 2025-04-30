@extends('landing-page.landing.main')
@section('content')
    <div class="wishlist-area">
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
                                        <th class="cart_btn">add to cart</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($wishlistCount > 0)
                                        @foreach ($wishlistItems as $item)
                                            <tr>
                                                <td class="product_remove">
                                                    <form action="{{ route('removeWishlist') }}" method="POST"
                                                        onsubmit="return confirm('Are you sure want to delete this item?')"
                                                        id="deleteForm">
                                                        @csrf
                                                        @method('DELETE')
                                                        <input type="hidden" name="rowId" value="{{ $item->rowId }}">
                                                        <button type="submit">
                                                            <i class="pe-7s-close" title="Remove"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                                <td class="product-thumbnail" style="width: 10%; height: auto">
                                                    <a href="#">
                                                        <img src="{{ asset('storage/' . $item->options->image) }}">
                                                    </a>
                                                </td>
                                                <td class="product-name"><a href="#">{{ $item->name }}</a></td>
                                                <td class="product-price"><span class="amount">Rp
                                                        {{ number_format($item->price, 0, ',', '.') }}</span></td>
                                                <td class="cart_btn">
                                                    <form action="{{ route('addCart') }}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="id" value="{{ $item->id }}">
                                                        <button type="submit">Add to cart</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="6">Wishlist is empty</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
