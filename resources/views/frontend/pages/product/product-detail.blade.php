@extends('frontend.layouts.master')

@section('content')
    <!-- Quick View Modal Area -->
    <div class="modal fade" id="quickview" tabindex="-1" role="dialog" aria-labelledby="quickview" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <button type="button" class="close btn" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="modal-body">
                    <div class="quickview_body">
                        <div class="container">
                            <div class="row">
                                <div class="col-12 col-lg-5">
                                    <div class="quickview_pro_img">
                                        <img class="first_img" src="img/product-img/new-1-back.png" alt="">
                                        <img class="hover_img" src="img/product-img/new-1.png" alt="">
                                        <!-- Product Badge -->
                                        <div class="product_badge">
                                            <span class="badge-new">New</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-7">
                                    <div class="quickview_pro_des">
                                        <h4 class="title">Boutique Silk Dress</h4>
                                        <div class="top_seller_product_rating mb-15">
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                        </div>
                                        <h5 class="price">$120.99 <span>$130</span></h5>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Mollitia expedita quibusdam aspernatur, sapiente consectetur accusantium perspiciatis praesentium eligendi, in fugiat?</p>
                                        <a href="#">View Full Product Details</a>
                                    </div>
                                    <!-- Add to Cart Form -->
                                    <form class="cart" method="post">
                                        <div class="quantity">
                                            <input type="number" class="qty-text" id="qty" step="1" min="1" max="12" name="quantity" value="1">
                                        </div>
                                        <button type="submit" name="addtocart" value="5" class="cart-submit">Add to cart</button>
                                        <!-- Wishlist -->
                                        <div class="modal_pro_wishlist">
                                            <a href="wishlist.html"><i class="icofont-heart"></i></a>
                                        </div>
                                        <!-- Compare -->
                                        <div class="modal_pro_compare">
                                            <a href="compare.html"><i class="icofont-exchange"></i></a>
                                        </div>
                                    </form>
                                    <!-- Share -->
                                    <div class="share_wf mt-30">
                                        <p>Share with friends</p>
                                        <div class="_icon">
                                            <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                                            <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                                            <a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a>
                                            <a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
                                            <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                                            <a href="#"><i class="fa fa-envelope-o" aria-hidden="true"></i></a>
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
    <!-- Quick View Modal Area -->

    <!-- Breadcumb Area -->
    <div class="breadcumb_area">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <h5>Product Details</h5>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Shop</a></li>
                        <li class="breadcrumb-item active">Product Details</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcumb Area -->
    @include('backend.layouts.notification')
    <!-- Single Product Details Area -->
    <section class="single_product_details_area section_padding_100">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-6">
                    <div class="single_product_thumb">
                        <div id="product_details_slider" class="carousel slide" data-ride="carousel">

                            <!-- Carousel Inner -->
                            <div class="carousel-inner">
                                @php
                                    $photos=explode(',',$product->photo)
                                @endphp
                                @foreach ($photos as $key=>$photo)
                                    <div class="carousel-item {{$key==0 ? 'active': '' }}">
                                        <a class="gallery_img" href="{{$photo}}" title="{{$product->title}}">
                                            <img class="d-block w-100" src="{{$photo}}" alt="{{$product->title}}">
                                        </a>
                                        <!-- Product Badge -->
                                        <div class="product_badge">
                                            <span class="badge-new">New</span>
                                        </div>
                                    </div>
                                @endforeach


                            </div>

                            <!-- Carosel Indicators -->
                            <ol class="carousel-indicators">
                                @php
                                    $photos=explode(',',$product->photo)
                                @endphp
                                @foreach ($photos as $key=>$photo)
                                    <li class="{{$key==0 ? 'active': '' }}" data-target="#product_details_slider" data-slide-to="{{$key}}" style="background-image: url({{$photo}});">
                                    </li>
                                @endforeach

                            </ol>
                        </div>
                    </div>
                </div>

                <!-- Single Product Description -->
                <div class="col-12 col-lg-6">
                    <div class="single_product_desc">
                        <h4 class="title mb-2">{{$product->title}}</h4>
                        <div class="single_product_ratings mb-2">
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <span class="text-muted">(8 Reviews)</span>
                        </div>
                        <h4 class="price mb-4">${{number_format($product->offer_price)}} <span>${{number_format($product->price)}}</span></h4>

                        <!-- Overview -->
                        <div class="short_overview mb-4">
                            <h6>Overview</h6>
                            <p>{!! html_entity_decode($product->summary) !!}</p>
                        </div>

                        <!-- Color Option -->
                        {{-- <div class="widget p-0 color mb-3">
                            <h6 class="widget-title">Color</h6>
                            <div class="widget-desc d-flex">
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="customRadio1" name="customRadio" class="custom-control-input">
                                    <label class="custom-control-label black" for="customRadio1"></label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="customRadio2" name="customRadio" class="custom-control-input">
                                    <label class="custom-control-label pink" for="customRadio2"></label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="customRadio3" name="customRadio" class="custom-control-input">
                                    <label class="custom-control-label red" for="customRadio3"></label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="customRadio4" name="customRadio" class="custom-control-input">
                                    <label class="custom-control-label purple" for="customRadio4"></label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="customRadio5" name="customRadio" class="custom-control-input">
                                    <label class="custom-control-label white" for="customRadio5"></label>
                                </div>
                            </div>
                        </div> --}}

                        <!-- Size Option -->
                        <div class="widget p-0 size mb-3">
                            <h6 class="widget-title">Size</h6>
                            @php
                                $productAttribute= \App\Models\ProductAttribute::where('product_id',$product->id)->get();
                            @endphp
                            <div class="widget-desc">
{{--                                <ul>--}}
{{--                                    @foreach($productAttribute as $attribute)--}}
{{--                                        <li><a href="#">{{$attribute->size}}</a></li>--}}
{{--                                    @endforeach--}}
                                    <select name="size" id="" class="form-control-sm mb-5 pt-0">
                                        @foreach($productAttribute as $attribute)
                                        <option value="{{$attribute->size}}">{{$attribute->size}}</option>
                                        @endforeach
                                    </select>
{{--                                </ul>--}}
                            <!-- Add to Cart Form -->
                                <form class="cart clearfix my-5 d-flex flex-wrap align-items-center" method="post">
                                    {{--                                <div class="quantity">--}}
                                    {{--                                    <input type="number" class="qty-text form-control" id="qty2" step="1" min="1" max="12" name="quantity" value="1">--}}
                                    {{--                                </div>--}}
                                    <button type="submit" name="addtocart" value="5" class="btn btn-primary mt-1 mt-md-0 ml-1 ml-md-3">Add to cart</button>
                                </form>
                            </div>

                        </div>

                        <!-- Others Info -->
                        <div class="others_info_area mb-3 d-flex flex-wrap">
                            <a class="add_to_wishlist" href="wishlist.html"><i class="fa fa-heart" aria-hidden="true"></i> WISHLIST</a>
                            <a class="add_to_compare" href="compare.html"><i class="fa fa-th" aria-hidden="true"></i> COMPARE</a>
                            <a class="share_with_friend" href="#"><i class="fa fa-share" aria-hidden="true"></i> SHARE WITH FRIEND</a>
                        </div>

                        <!-- Size Guide -->
                        <div class="sizeguide">
                            <h6>Size Guide</h6>
                            @php
                                $size_guide=explode(',',$product->size_guide)
                            @endphp

                            <div class="size_guide_thumb d-flex">
                                @foreach($size_guide as $sig)
                                <a class="size_guide_img" href="{{$sig}}" style="background-image: url({{$sig}});">
                                </a>
                                @endforeach
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="product_details_tab section_padding_100_0 clearfix">
                        <!-- Tabs -->
                        <ul class="nav nav-tabs" role="tablist" id="product-details-tab">
                            <li class="nav-item">
                                <a href="#description" class="nav-link active" data-toggle="tab" role="tab">Description</a>
                            </li>
                            <li class="nav-item">
                                @php
                                    $productReview=\App\Models\ProductReview::where('product_id',$product->id)->get();
                                @endphp
                                <a href="#reviews" class="nav-link" data-toggle="tab" role="tab">
                                    Reviews
                                    <span class="text-muted">({{count($productReview)}})</span></a>
                            </li>
                            <li class="nav-item">
                                <a href="#addi-info" class="nav-link" data-toggle="tab" role="tab">Additional Information</a>
                            </li>
                            <li class="nav-item">
                                <a href="#refund" class="nav-link" data-toggle="tab" role="tab">Return &amp; Cancellation</a>
                            </li>
                        </ul>
                        <!-- Tab Content -->
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane fade show active" id="description">
                                <div class="description_area">
                                    <h5>Description</h5>
                                    <p>{!! html_entity_decode($product->description) !!}</p>
                                </div>
                            </div>

                            <div role="tabpanel" class="tab-pane fade" id="reviews">

                                <div class="submit_a_review_area mt-50">
                                    <p><a href="{{route('user.auth')}}">Click here!</a> to Login</p>
                                @auth
                                    <form action="{{route('product.review',$product->slug)}}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <span>Your Ratings</span>
                                            <div class="stars">
                                                <input type="radio" name="rate" class="star-1" id="star-1" value="1">
                                                <label class="star-1" for="star-1">1</label>
                                                <input type="radio" name="rate" class="star-2" id="star-2" value="2">
                                                <label class="star-2" for="star-2">2</label>
                                                <input type="radio" name="rate" class="star-3" id="star-3" value="3">
                                                <label class="star-3" for="star-3">3</label>
                                                <input type="radio" name="rate" class="star-4" id="star-4" value="4">
                                                <label class="star-4" for="star-4">4</label>
                                                <input type="radio" name="rate" class="star-5" id="star-5" value="5">
                                                <label class="star-5" for="star-5">5</label>
                                                <span></span>
                                            </div>
                                            @error('rate')
                                            <p class="text-danger">{{$message}}</p>
                                            @enderror
                                        </div>
                                        <input type="text" hidden name="user_id" value="{{auth()->user()->id}}">
                                        <input type="text" hidden name="product_id" value="{{$product->id}}">
                                        <div class="form-group">
                                            <label for="name">Nickname</label>
                                            <input type="text" class="form-control" id="name" name="name" value="{{auth()->user()->full_name}}" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="options">Reason for your rating</label>
                                            <select name="reason" class="form-control small right py-0 w-100" id="options">
                                                <option value="quality" {{old('reason')=='quality'? 'selected': ''}}>Quality</option>
                                                <option value="value" {{old('reason')=='value'? 'selected': ''}}>Value</option>
                                                <option value="design" {{old('reason')=='design'? 'selected': ''}}>Design</option>
                                                <option value="price" {{old('reason')=='price'? 'selected': ''}}>Price</option>
                                                <option value="others" {{old('reason')=='others'? 'selected': ''}}>Others</option>
                                            </select>
                                        </div>
                                        @error('reason')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                        <div class="form-group">
                                            <label for="comments">Comments</label>
                                            <textarea class="form-control" id="comments" name="review" rows="5" data-max-length="150"></textarea>
                                        </div>
                                        @error('review')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                        <button type="submit" class="btn btn-primary">Submit Review</button>
                                    </form>
                                </div>
                                @else
                                    <p>You need to login for giving a review</p>
                                @endif
                                <br>
                                <div class="reviews_area mt-5">
                                    @php
                                        $productReviews=\App\Models\ProductReview::where('product_id',$product->id)->latest()->get();
                                    @endphp
                                    <ul>
                                        <li>
                                            @if(count($productReviews)>0)
                                                @foreach($productReviews as $review)
                                                    <div class="single_user_review mb-15">
                                                        <div class="review-rating">
                                                            @for($i=0; $i < $review->rate; $i++)
                                                                <i class="fa-solid fa-star"></i>
                                                            @endfor
                                                            <span>for {{$review->reason}}</span>
                                                        </div>
                                                        <div class="review-details">
                                                            <p>by <a href="#">{{\App\Models\User::where('id',$review->user_id)->value('full_name')}}</a> on <span>{{\Carbon\Carbon::parse($review->created_at)->format('M d Y')}}</span></p>
                                                        </div>
                                                        <p>{{$review->review}}</p>
                                                    </div>
                                                @endforeach
                                            @endif
                                        </li>
                                    </ul>
                                </div>


                            </div>

                            <div role="tabpanel" class="tab-pane fade" id="addi-info">
                                <div class="additional_info_area">
                                    <h5>Additional Info</h5>
                                    <p>{!! html_entity_decode($product->additional_info) !!}</p>
                                </div>
                            </div>

                            <div role="tabpanel" class="tab-pane fade" id="refund">
                                <div class="refund_area">
                                    <h6>Return Policy</h6>
                                    {!! html_entity_decode($product->return_cancellation) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Single Product Details Area End -->

    <!-- Related Products Area -->
    <section class="you_may_like_area section_padding_0_100 clearfix">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section_heading new_arrivals">
                        <h5>You May Also Like</h5>
                    </div>
                </div>
            </div>
            @if (count($product->related_product)>0)
            <div class="row">
                <div class="col-12">
                    <div class="you_make_like_slider owl-carousel">
                        <!-- Single Product -->
                        @foreach ($product->related_product as $item)
                        @if ($item->id != $product->id)
                        <div class="single-product-area">
                            <div class="product_image">
                                <!-- Product Image -->
                                @php
                                    $photo=explode(',',$item->photo)
                                @endphp

                                    @if(isset($photo[0]))
                                    <img class="normal_img" src="{{$photo[0]}}" alt="{{$item->title}}">
                                    @endif
                                    @if(isset($photo[1]))
                                    <img class="hover_img" src="{{$photo[1]}}" alt="{{$item->title}}">
                                    @endif

                                <!-- Product Badge -->
                                <div class="product_badge">
                                    <span>{{$item->condition}}</span>
                                </div>

                                <!-- Wishlist -->
                                <div class="product_wishlist">
                                    <a href="wishlist.html"><i class="icofont-heart"></i></a>
                                </div>

                                <!-- Compare -->
                                <div class="product_compare">
                                    <a href="compare.html"><i class="icofont-exchange"></i></a>
                                </div>
                            </div>

                            <!-- Product Description -->
                            <div class="product_description">
                                <!-- Add to cart -->
                                <div class="product_add_to_cart">
                                    <a href="#"><i class="icofont-shopping-cart"></i> Add to Cart</a>
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
                        @endif
                        @endforeach

                    </div>
                </div>

            </div>
            @endif
        </div>
    </section>
    <!-- Related Products Area -->
@endsection
