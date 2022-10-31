@extends('frontend.layouts.master')
@section('content')
    <!-- Breadcumb Area -->
    <div class="breadcumb_area">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <h5>Checkout</h5>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('user.home')}}">Home</a></li>
                        <li class="breadcrumb-item active">Checkout</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcumb Area -->

    <!-- Checkout Step Area -->
    <div class="checkout_steps_area">
        <a class="complated" href="{{route('checkout1')}}"><i class="icofont-check-circled"></i> Billing</a>
        <a class="complated" href="checkout-3.html"><i class="icofont-check-circled"></i> Shipping</a>
        <a class="complated" href="checkout-4.html"><i class="icofont-check-circled"></i> Payment</a>
        <a class="active" href="checkout-5.html"><i class="icofont-check-circled"></i> Review</a>
    </div>
    <!-- Checkout Step Area -->

    <!-- Checkout Area -->
    <div class="checkout_area section_padding_100">
        <div class="container">
            <div class="row" id="cart_list">
                @include('frontend.layouts._checkout4')
            </div>
        </div>
    </div>
    <!-- Checkout Area End -->
@endsection

@section('scripts')

    {{--DELETE?--}}
    <script>
        $(document).on('click','#cart_delete',function(){
            var cart_id=$(this).data('id');
            var token="{{csrf_token()}}";
            var path="{{route('cart.delete')}}";
            $.ajax({
                url:path,
                type:"POST",
                dataType: "JSON",
                data:{
                    cart_id:cart_id,
                    _token:token,
                },
                success:function (data) {
                    console.log(data);

                    $('body #header-ajax').html(data['header']);
                    $('body #cart_counter').html(data['cart_count']);
                    $('body #cart_list').html(data['cart_list']);
                    // $('body div #cart-index-ajax').html(data['cart_index']);

                    if(data['status']){
                        swal({
                            title: "Good job!",
                            text: data['message'],
                            icon: "success",
                            button: "OK!",
                        });
                    }
                    // setTimeout(function(){
                    //     // $('#cart-index-ajax').reload(); // then reload the page.(3)
                    //     location.reload(); // then reload the page.(3)
                    // }, 2000)
                },
                error:function (err) {
                    console.log(err);
                }
            });
        });
    </script>
    <script>
        $(document).on('click','.qty-text',function(){
            var id=$(this).data('id');
            var spinner=$(this),input=spinner.closest("div.quantity").find('input[type=number]');
            // alert(input.val());
            if(input.val()==0){
                return false;
            }

            if(input.val()!=1){
                var newVal=parseFloat(input.val());
                $('#qty-input-'+id).val(newVal);
            }
            var productQuantity=$("#update-cart-"+id).data('product-quantity');
            update_cart(id,productQuantity);

        });
        function update_cart(id,productQuantity) {
            var rowId=id;
            var product_qty=$('#qty-input-'+rowId).val();
            var token="{{csrf_token()}}";
            var path="{{route('cart.update')}}";
            $.ajax({
                url:path,
                type:"POST",
                data:{
                    _token: token,
                    product_qty:product_qty,
                    rowId:rowId,
                    productQuantity:productQuantity,
                },
                success:function(data){
                    console.log(data['message']);
                    $('body #header-ajax').html(data['header']);
                    $('body #cart_counter').html(data['cart_count']);
                    $('body #cart_list').html(data['cart_list']);
                    if(data['status']){
                        swal({
                            title: "Good job!",
                            text: data['message'],
                            icon: "success",
                            button: "OK!",
                        });
                    }
                    else{
                        alert(data['message']);
                    }
                }
            })
        }
    </script>
@endsection

