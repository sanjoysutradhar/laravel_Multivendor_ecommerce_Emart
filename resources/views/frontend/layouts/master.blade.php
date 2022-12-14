<!doctype html>
<html lang="en">

<head>
    @include('frontend.layouts.head')
</head>

<body>
    <!-- Preloader -->
    {{-- <div id="preloader">
        <div class="spinner-grow" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div> --}}

    <!-- Header Area -->
    <header class="header_area" id="header-ajax">
        @include('frontend.layouts.header')
    </header>
    <!-- Header Area End -->

{{--    <div class="container">--}}
{{--        <div class="row">--}}
{{--            <div class="col-md-12">--}}
{{--                @include('backend.layouts.notification')--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

    @yield('content')

    <!-- Footer Area -->
    @include('frontend.layouts.footer')
    <!-- Footer Area -->

    <!-- jQuery (Necessary for All JavaScript Plugins) -->
    @include('frontend.layouts.script')
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    @yield('scripts')
    <script>
        $(document).ready(function(){
           var path='{{route('autoSearch')}}';
           $('#search-text').autocomplete({
               source:function (request,response){
                   $.ajax({
                       url:path,
                       dataType:"JSON",
                       data:{
                           term:request.term
                       },
                       success:function (data){
                           console.log(data);
                           response(data);
                       }
                   });
            },
               minLength:1,
           });
        });
    </script>
{{--    <script>--}}
{{--        $(document).on('click','.cart_delete',function(){--}}
{{--            var cart_id=$(this).data('id');--}}
{{--            var token="{{csrf_token()}}";--}}
{{--            var path="{{route('cart.delete')}}";--}}
{{--            $.ajax({--}}
{{--                url:path,--}}
{{--                type:"POST",--}}
{{--                dataType: "JSON",--}}
{{--                data:{--}}
{{--                    cart_id:cart_id,--}}
{{--                    _token:token,--}}
{{--                },--}}
{{--                success:function (data) {--}}
{{--                    console.log(data);--}}

{{--                    if(data['status']){--}}
{{--                        $('body #header-ajax').html(data['header']);--}}
{{--                        swal({--}}
{{--                            title: "Good job!",--}}
{{--                            text: data['message'],--}}
{{--                            icon: "success",--}}
{{--                            button: "OK!",--}}
{{--                        });--}}
{{--                    }--}}
{{--                },--}}
{{--                error:function (err) {--}}
{{--                    console.log(err);--}}
{{--                }--}}
{{--            });--}}
{{--        });--}}
{{--    </script>--}}
<script>
    function currency_change(currency_code){
        // alert(currency_code);
        // console.log(currency_code);
        $.ajax({
            type:'POST',
            url:'{{route('currency.load')}}',
            data:{
                currency_code:currency_code,
                _token:'{{csrf_token()}}',
            },
            success:function(response){
                if(response['status']){
                    location.reload();
                }else{
                    alert('server error');
                }
            },
            error: function() {
                alert('hi error');
            }
        })

    }
</script>
</body>

</html>
