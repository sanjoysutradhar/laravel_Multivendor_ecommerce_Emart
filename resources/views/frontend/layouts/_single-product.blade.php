{{--@if (count($products)>0)--}}
    {{--                            @if (count($categories->products)>0)--}}
    <!-- Single Product -->
    @foreach ($products as $item)

        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
            <div class="single-product-area mb-30">
                <div class="product_image">
                @php
                    $photos=explode(',',$item->photo);
                @endphp
                <!-- Product Image -->
                    @if(isset($photos[0]))
                        <img class="normal_img" src="{{$photos[0]}}" alt="{{$item->title}}">
                    @endif
                    @if(isset($photos[1]))
                        <img class="hover_img" src="{{$photos[1]}}" alt="">
                    @endif

                    <!-- Product Badge -->
                    <div class="product_badge">
                        <span>{{$item->condition}}</span>
                    </div>
{{--                    @auth--}}
                    <!-- Wishlist -->
                    <div class="product_wishlist">
                        <a href="javascript:void(0);" class="add_to_wishlist" data-quantity="1" data-product-id="{{$item->id}}" id="add_to_wishlist_{{$item->id}}"><i class="icofont-heart"></i></a>
                    </div>
{{--                    @else--}}
{{--                        <div class="product_wishlist">--}}
{{--                            <a href="javascript:void(0);" class="add_to_wishlist_login" ><i class="icofont-heart"></i></a>--}}
{{--                        </div>--}}
{{--                    @endauth--}}
                    <!-- Compare -->
                    <div class="product_compare">
                        <a href="compare.html"><i class="icofont-exchange"></i></a>
                    </div>
                </div>

                <!-- Product Description -->
                <div class="product_description">
                    <!-- Add to cart -->
                    <div class="product_add_to_cart">
{{--                        @auth--}}
                            <a href="#" data-quantity="1" data-product-id="{{$item->id}}" class="add_to_cart"><i class="icofont-shopping-cart"></i> Add to Cart</a>
{{--                        @else--}}
{{--                            <a href="{{route('user.auth')}}"><i class="icofont-shopping-cart"></i> Add to Cart</a>--}}
{{--                        @endauth--}}
                    </div>

                    <!-- Quick View -->
                    <div class="product_quick_view">
                        <a href="#" data-toggle="modal" data-target="#quickview"><i class="icofont-eye-alt"></i> Quick View</a>
                    </div>

                    <p class="brand_name">{{\App\Models\Brand::where('id',$item->brand_id)->value('title')}}</p>
                    <a href="{{route('product.detail',$item->slug)}}">{{ucfirst($item->title)}}</a>
                    <h6 class="product-price">
                        ${{number_format($item->offer_price,2)}}
                        <small>
                            <del class="text-danger">
                                ${{number_format($item->price,2)}}
                            </del>
                        </small>
                    </h6>
                </div>
            </div>
        </div>

    @endforeach

