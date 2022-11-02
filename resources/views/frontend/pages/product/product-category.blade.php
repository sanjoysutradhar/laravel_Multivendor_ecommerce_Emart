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
                        <li class="breadcrumb-item"><a href="\">Home</a></li>
                        <li class="breadcrumb-item active">{{$categories->title}}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcumb Area -->

    <section class="shop_grid_area section_padding_100">
        <div class="container">
            <div class="row">
                <div class="col-12">
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
                        <select id="sortBy" class="small right">
                            <option selected>default sort</option>
                            <option value="priceAsc">Price -lower to higher</option>
                            <option value="priceDesc">Price - higher to lower</option>
                            <option value="titleAsc">Alphabetical Ascending</option>
                            <option value="titleDesc">Alphabetical descending</option>
                            <option value="discountAsc">Discount -lower to higher</option>
                            <option value="discountDesc">Discount - higher to lower</option>
                        </select>
                    </div>

                    <div class="shop_grid_product_area">
                        <div class="row justify-content-center" id="product-data">

                        @include('frontend.layouts._single-product')

                        </div>
                    </div>

                    <!-- Shop Pagination Area -->
                    <div id="ajax-load" class="ajax-load text-center" style="display: none">
                        <img src="{{asset('frontend/img/loader.gif')}}" alt="loader" style="width: 15%">
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection


@section('scripts')
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
{{--    <script src="{{asset('frontend/assets/js/jquery-3.6.1.js')}}"></script>--}}

{{--//data filter--}}
    <script>
        $('#sortBy').change(function(){
            var sort= $('#sortBy').val();
           window.location="{{url(''.$route.'')}}/{{$categories->slug}}?sort="+sort;
        });
    </script>

{{--Data loading with Ajax--}}
    <script>
        var page=1;
        $(window).scroll(function () {
            if($(window).scrollTop() + $(window).height()>=$(document).height()){
                page ++;
                loadmoreData(page)
            }
        })
        function loadmoreData(page){
            $.ajax({
                // url:'?page='+page,
                {{--url:"{{route('load.product',"+ $categories->slug +")}}?page="+page,--}}
                url:"{{route('load.product',$categories->slug)}}?page="+page,
                type:'GET',
                dataType: 'JSON',
                beforeSend:function(){
                    $('.ajax-load').show();
                },
                success: function (data) {
                    if(data.html==''){
                        $('.ajax-load').html("No more product available");
                        return;
                    }
                    $('.ajax-load').hide();
                    $('#product-data').append(data.html);
                }
            })
            // .done(function(data){
            //     console.log(data)
            //     if(data.html==''){
            //         $('.ajax-load').html("No more product available");
            //         return;
            //     }
            //     $('.ajax-load').hide();
            //     $('#product-data').append(data.html);
            // })
            .fail(function(){
                alert('Something went wrong! please try again');
            });

        }
    </script>
{{--    add to cart--}}
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

{{--    <script>--}}
{{--        $(document).on('click','.add_to_wishlist_login',function () {--}}
{{--            alert("You should login first!");--}}
{{--        })--}}
{{--    </script>--}}
@endsection

