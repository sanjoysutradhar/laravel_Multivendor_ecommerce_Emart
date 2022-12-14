@extends('frontend.layouts.master')
@section('content')
    <!-- Breadcumb Area -->
    <div class="breadcumb_area">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <h5>Cart</h5>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('user.home')}}">Home</a></li>
                        <li class="breadcrumb-item active">Cart</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcumb Area -->

    <!-- Cart Area -->
    <div class="cart_area section_padding_100_70 clearfix" >
        <div class="container">
            <div class="row justify-content-between" id="cart_list">
                @include('frontend.layouts._cart-lists')

            </div>
        </div>
    </div>
    <!-- Cart Area End -->

@endsection
@section('scripts')
{{--    //coupon add--}}
    <script>
    $(document).on('click','.coupon-btn',function (e) {
        e.preventDefault();
        var code=$('input[name=code]').val();
        $('.coupon-btn').html('<i class="fa-solid fa-spinner"></i> Applying...');
        $('#coupon-form').submit();

    })
</script>
{{--?--}}
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
    <script>
        $(document).on('click','.procees_to_checkout',function (e) {
            e.preventDefault();
            var count= $(this).data('value');
            if(count>0){
                location.replace("{{ route('checkout1')}}");
            }
            else{
                swal({
                    title: "OPS!",
                    text: "Add Some Products",
                    icon: "warning",
                    button: "OK!",
                });
            }
        })
    </script>
@endsection
