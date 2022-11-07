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
                    <h5>Shop Grid</h5>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Shop Grid</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcumb Area -->

    <section class="shop_grid_area section_padding_100">
        <div class="container">
            <form action="{{route('shop.filter')}}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-12 col-sm-5 col-md-4 col-lg-3">

                            <div class="shop_sidebar_area">
                            @if(!empty($categories))
                                <!-- Single Widget -->
                                    <div class="widget catagory mb-30">
                                        <h6 class="widget-title">Product Categories</h6>
                                        <div class="widget-desc">
                                            @if(!empty($_GET['category']))
                                                @php
                                                    $filter_cats=explode(',',$_GET['category']);
                                                @endphp

                                            @endif

                                        @foreach($categories as $item)
                                            <!-- Single Checkbox -->
                                                <div class="custom-control custom-checkbox d-flex align-items-center mb-2">
                                                    <input type="checkbox" @if(!empty($filter_cats) && in_array($item->slug, $filter_cats)) checked @endif class="custom-control-input" id="{{$item->slug}}" name="category[]" onchange="this.form.submit();" value="{{$item->slug}}">
                                                    <label class="custom-control-label" for="{{$item->slug}}">{{ucfirst($item->title)}}<span class="text-muted">({{count($item->products)}})</span></label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                            @endif
                            <!-- Single Widget -->
                                <div class="widget price mb-30">
                                    <h6 class="widget-title">Filter by Price</h6>
                                    <div class="widget-desc">
                                        <div class="slider-range">
                                            <div id="slider-range" data-min="{{Helper::minPrice()}}" data-max="{{Helper::maxPrice()}}" data-unit="$" class="slider-range-price ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all" data-value-min="{{Helper::minPrice()}}" data-value-max="{{Helper::maxPrice()}}" data-label-result="price">
                                                <div class="ui-slider-range ui-widget-header ui-corner-all"></div>
                                                <span class="ui-slider-handle ui-state-default ui-corner-all" tabindex="0"></span>
                                                <span class="ui-slider-handle ui-state-default ui-corner-all" tabindex="0"></span>
                                            </div>
                                            <div class="d-flex mt-2 p-0 input-group">
                                                @if(!empty($_GET['price']))
                                                    @php
                                                        $price=explode('-',$_GET['price']);
                                                    @endphp
                                                @endif

                                                <input type="hidden" name="price_range" id="price_range" value="@if(!empty($_GET['price'])) {{$_GET['price']}} @else {{Helper::minPrice()}}-{{Helper::maxPrice()}} @endif">
                                                <input type="text" class="form-control rounded-left px-0 text-center col-8" readonly id="amount" value="@if(!empty($_GET['price'])) {{$price[0]}} @else {{Helper::minPrice()}} @endif - @if(!empty($_GET['price'])) {{$price[1]}} @else {{Helper::maxPrice()}} @endif">
{{--                                                <div class="range-price" >Price: ${{Helper::minPrice()}} - ${{Helper::maxPrice()}}</div>--}}
                                                <button type="submit" class="btn btn-sm btn-primary form-control border-0 px-0 col-4" >Price</button>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Single Widget -->
                                <div class="widget brands mb-30">
                                    <h6 class="widget-title">Filter by brands</h6>
                                    <div class="widget-desc">
                                        <!-- Single Checkbox -->
                                        @if(!empty($brands))

                                            @if(!empty($_GET['brand']))
                                                @php
                                                    $filter_brands=explode(',',$_GET['brand']);
                                                @endphp

                                            @endif
                                            @foreach($brands as $item)
                                                <div class="custom-control custom-checkbox d-flex align-items-center mb-2">
                                                    <input type="checkbox" class="custom-control-input" @if(!empty($filter_brands) && in_array($item->slug, $filter_brands)) checked @endif id="{{$item->slug}}" name="brand[]" onchange="this.form.submit();" value="{{$item->slug}}">
                                                    <label class="custom-control-label" for="{{$item->slug}}">{{ucfirst($item->title)}}<span class="text-muted">({{count($item->products)}})</span></label>
                                                </div>
                                            @endforeach
                                        @endif

                                    </div>
                                </div>

                                <!-- Single Widget -->
                                <div class="widget size mb-30">
                                    <h6 class="widget-title">Filter by Size</h6>
                                    @if(!empty($_GET['size']))
                                        @php
                                            $size_filer=explode(',',$_GET['size']);
                                        @endphp

                                    @endif
                                    <div class="widget-desc">
                                        <div class="widget-desc">
                                            <!-- Single Checkbox -->
                                            <div class="custom-control custom-checkbox d-flex align-items-center mb-2">
                                                <input type="checkbox" class="custom-control-input" id="customCheck1" @if(!empty($size_filer) && in_array('S',$size_filer)) checked @endif name="size[]" value="S" onchange="this.form.submit();">
                                                <label class="custom-control-label" for="customCheck1">S<span class="text-muted">({{\App\Models\Product::where(['status'=>'active','size'=>'S'])->count()}})</span></label>
                                            </div>
                                            <!-- Single Checkbox -->
                                            <div class="custom-control custom-checkbox d-flex align-items-center mb-2">
                                                <input type="checkbox" class="custom-control-input" id="customCheck2" @if(!empty($size_filer) && in_array('M',$size_filer)) checked @endif name="size[]" value="M" onchange="this.form.submit();">
                                                <label class="custom-control-label" for="customCheck2">M<span class="text-muted">({{\App\Models\Product::where(['status'=>'active','size'=>'M'])->count()}})</span></label>
                                            </div>
                                            <!-- Single Checkbox -->
                                            <div class="custom-control custom-checkbox d-flex align-items-center mb-2">
                                                <input type="checkbox" class="custom-control-input" id="customCheck3" @if(!empty($size_filer) && in_array('L',$size_filer)) checked @endif name="size[]" value="L" onchange="this.form.submit();">
                                                <label class="custom-control-label" for="customCheck3">L<span class="text-muted">({{\App\Models\Product::where(['status'=>'active','size'=>'L'])->count()}})</span></label>
                                            </div>
                                            <!-- Single Checkbox -->
                                            <div class="custom-control custom-checkbox d-flex align-items-center mb-2">
                                                <input type="checkbox" class="custom-control-input" id="customCheck4" @if(!empty($size_filer) && in_array('XL',$size_filer)) checked @endif name="size[]" value="XL" onchange="this.form.submit();">
                                                <label class="custom-control-label" for="customCheck4">XL<span class="text-muted">({{\App\Models\Product::where(['status'=>'active','size'=>'XL'])->count()}})</span></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                    </div>

                    <div class="col-12 col-sm-7 col-md-8 col-lg-9">
                        <!-- Shop Top Sidebar -->
                        <div class="shop_top_sidebar_area d-flex flex-wrap align-items-center justify-content-between">
                            <div class="view_area d-flex">
                                <div class="grid_view">
                                    <a href="shop-grid-left-sidebar.html" data-toggle="tooltip" data-placement="top" title="Grid View"><i class="icofont-layout"></i></a>
                                </div>
                                <div class="list_view ml-3">
                                    <a href="shop-list-left-sidebar.html" data-toggle="tooltip" data-placement="top" title="List View"><i class="icofont-listine-dots"></i></a>
                                </div>
                            </div>
                            <select id="sortBy" name="sortBy" onchange="this.form.submit()" class="small right">
                                <option selected value="">default sort</option>
                                <option value="priceAsc" @if(!empty($_GET['sortBy']) && $_GET['sortBy']=='priceAsc') selected @endif >Price -lower to higher</option>
                                <option value="priceDesc" @if(!empty($_GET['sortBy']) && $_GET['sortBy']=='priceDesc') selected @endif>Price - higher to lower</option>
                                <option value="titleAsc" @if(!empty($_GET['sortBy']) && $_GET['sortBy']=='titleAsc') selected @endif>Alphabetical Ascending</option>
                                <option value="titleDesc"  @if(!empty($_GET['sortBy']) && $_GET['sortBy']=='titleDesc') selected @endif>Alphabetical descending</option>
                                <option value="discountAsc" @if(!empty($_GET['sortBy']) && $_GET['sortBy']=='discountAsc') selected @endif>Discount -lower to higher</option>
                                <option value="discountDesc" @if(!empty($_GET['sortBy']) && $_GET['sortBy']=='discountDesc') selected @endif>Discount - higher to lower</option>
                            </select>
                        </div>

                        <div class="shop_grid_product_area">
    {{--                        <p>Total Products = {{count($products)}}</p>--}}
                            <div class="row justify-content-center">
                                <!-- Single Product -->
                                @if(!empty($products))
                                @foreach ($products as $item)
                                    <div class="col-9 col-sm-12 col-md-6 col-lg-4">
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


                                            <div class="product_badge">
                                                <span>{{$item->condition}}</span>
                                            </div>

                                            <div class="product_wishlist">
                                                <a href="javascript:void(0);" class="add_to_wishlist" data-quantity="1" data-product-id="{{$item->id}}" id="add_to_wishlist_{{$item->id}}"><i class="icofont-heart"></i></a>
                                            </div>

                                            <div class="product_compare">
                                                <a href="compare.html"><i class="icofont-exchange"></i></a>
                                            </div>
                                        </div>


                                        <div class="product_description">
                                            <!-- Add to cart -->
                                            <div class="product_add_to_cart">

                                                <a href="javascript:void(0);" data-quantity="1"  data-product-id="{{$item->id}}" class="add_to_cart"><i class="icofont-shopping-cart"></i> Add to Cart</a>

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
                                @else
                                <h1>There is no product</h1>
                                @endif
                            </div>
                        </div>

                        <!-- Shop Pagination Area -->
                        {{$products->appends($_GET)->links('vendor.pagination.custom')}}

                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection
@section('scripts')
{{--Price Slider--}}
<script>
    $(document).ready(function () {
        if($('#slider-range').length > 0){
            const max_price=parseInt($('#slider-range').data('max'));
            const min_price=parseInt($('#slider-range').data('min'));
            let price_range=min_price+'-'+max_price;

            if($('#price_range').length>0 && $('#price_range').val()){
                price_range=$('#price_range').val().trim();
            }
            let price=price_range.split('-');

            $('#slider-range').slider({
                range:true,
                min:min_price,
                max:max_price,
                values:price,
                slide:function(event,ui){
                    $('#amount').val("$"+ui.values[0]+"-$"+ui.values[1]);
                    $('#price_range').val(ui.values[0]+"-"+ui.values[1]);
            }
            })
            // alert(price_range);

        }
    })
</script>

{{--    Add to Cart--}}
    <script>
        $(document).on('click','.add_to_cart',function(){
            var product_id=$(this).data('product-id');
            var product_qty=$(this).data('quantity');
            // alert(product_qut);
            var token="{{csrf_token()}}";
            var path="{{route('cart.store')}}";
            $.ajax({
                url:path,
                type:"POST",
                dataType: "JSON",
                data:{
                    product_id:product_id,
                    product_qty:product_qty,
                    _token:token,
                },
                beforeSend:function () {
                    // $('.add_to_cart' + product_id).html("<i class='fa fa-spinner fa-spin'></i>");
                    // console.log($(".add_to_cart").html("<i class='fa fa-spinner fa-spin'></i>"));
                    $('.add_to_cart').html("<i class='fa fa-spinner fa-spin'></i>Loading...");
                },
                complete:function () {
                    $('.add_to_cart').html("<i class='icofont-shopping-cart'></i>Add to Cart");
                },
                success:function (data) {
                    console.log(data);
                    if(data['status']){
                        $('body #header-ajax').html(data['header']);
                        $('body #cart-counter').html(data['cart_count']);
                        swal({
                            title: "Good job!",
                            text: data['message'],
                            icon: "success",
                            button: "OK!",
                        });
                    }
                },
                error:function (err) {
                    console.log(err);
                }
            });
        });
    </script>

    {{--    add to wishlist--}}
    <script>
        $(document).on('click','.add_to_wishlist',function(){
            var product_id=$(this).data('product-id');
            var product_qty=$(this).data('quantity');
            // alert(product_qut);
            var token="{{csrf_token()}}";
            var path="{{route('wishlist.store')}}";
            $.ajax({
                url:path,
                type:"POST",
                dataType: "JSON",
                data:{
                    product_id:product_id,
                    product_qty:product_qty,
                    _token:token,
                },
                beforeSend:function () {
                    // $('.add_to_cart' + product_id).html("<i class='fa fa-spinner fa-spin'></i>");
                    // console.log($(".add_to_cart").html("<i class='fa fa-spinner fa-spin'></i>"));
                    $('.add_to_wishlist').html("<i class='fa fa-spinner fa-spin'></i>");
                },
                complete:function () {
                    $('.add_to_wishlist').html("<i class='icofont-heart'></i>");
                },
                success:function (data) {
                    console.log(data);
                    if(data['status']){
                        $('body #header-ajax').html(data['header']);
                        // $('body #wishlist_count').html(data['wishlist_count']);
                        swal({
                            title: "Good job!",
                            text: data['message'],
                            icon: "success",
                            button: "OK!",
                        });
                    }
                    else if(data['present']){
                        swal({
                            title: "Opps!",
                            text: data['message'],
                            icon: "warning",
                            button: "OK!",
                        });
                    }
                    else{
                        swal({
                            title: "Sorry!",
                            text: "You  can't add that product",
                            icon: "Error",
                            button: "OK!",
                        });
                    }
                },
                error:function (err) {
                    console.log(err);
                }
            });
        });
    </script>

@endsection

