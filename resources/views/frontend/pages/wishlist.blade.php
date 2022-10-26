@extends('frontend.layouts.master')
@section('content')
    <!-- Breadcumb Area -->
    <div class="breadcumb_area">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <h5>Wishlist</h5>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('user.home')}}">Home</a></li>
                        <li class="breadcrumb-item active">Wishlist</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcumb Area -->

    <!-- Wishlist Table Area -->
    <div class="wishlist-table section_padding_100 clearfix">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="cart-table wishlist-table">
                        <div class="table-responsive" id="wishlist_list">
                            @include('frontend.layouts._wishlist')
                        </div>
                    </div>

                    <div class="cart-footer text-right">
                        <div class="back-to-shop">
                            <a href="#" class="btn btn-primary">Add All Item</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Wishlist Table Area -->
@endsection
@section('scripts')
    <script>
        $(document).on('click','.move_to_cart',function(e) {
            e.preventDefault();
            var rowId=$(this).data('id');
            var token="{{csrf_token()}}";
            var path="{{route('wishlist.move.cart')}}";
             $.ajax({
                 url:path,
                 type:"POST",
                 data:{
                     _token:token,
                     rowId:rowId,
                 },
                 beforeSend:function() {
                    $(this).html("<i class='fa fa-spinner fa-spin'></i>Moving to cart..");
                 },
                 success:function(data){
                     console.log(data);
                     if(data['status']){
                         $('body #header-ajax').html(data['header']);
                         $('body #wishlist_list').html(data['wishlist_list']);
                         $('body #cart-counter').html(data['cart_count']);
                         swal({
                             title: "Success!",
                             text: data['message'],
                             icon: "success",
                             button: "OK!",
                         });
                     }
                     else{
                         swal({
                             title: "Opps!",
                             text: "You  can't move that product",
                             icon: "warning",
                             button: "OK!",
                         });
                     }
                 },
                 error:function (err) {
                     swal({
                         title: "Error!",
                         text: "Something Went Wrong",
                         icon: "error",
                         button: "OK!",
                     });
                 }

             });
        });
    </script>

    <script>
        $(document).on('click','.delete_wishlist',function(e) {
            e.preventDefault();
            var rowId=$(this).data('id');
            var token="{{csrf_token()}}";
            var path="{{route('wishlist.delete')}}";
            $.ajax({
                url:path,
                type:"POST",
                data:{
                    _token:token,
                    rowId:rowId,
                },

                success:function(data){
                    console.log(data);
                    if(data['status']){
                        $('body #header-ajax').html(data['header']);
                        $('body #wishlist_list').html(data['wishlist_list']);
                        $('body #cart-counter').html(data['cart_count']);
                        swal({
                            title: "Success!",
                            text: data['message'],
                            icon: "success",
                            button: "OK!",
                        });
                    }
                    else{
                        swal({
                            title: "Opps!",
                            text: "You  can't move that product",
                            icon: "warning",
                            button: "OK!",
                        });
                    }
                },
                error:function (err) {
                    swal({
                        title: "Error!",
                        text: "Something Went Wrong",
                        icon: "error",
                        button: "OK!",
                    });
                }

            });
        });
    </script>
@endsection

