@extends('frontend.layouts.master')
@section('content')
    <!-- Breadcumb Area -->
    <div class="breadcumb_area">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <h5>Checkout</h5>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item active">Checkout</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcumb Area -->

    <!-- Checkout Step Area -->
    <div class="checkout_steps_area">
        <a class="active" href="{{route('checkout1')}}"><i class="icofont-check-circled"></i> Billing</a>
        <a href="checkout-3.html"><i class="icofont-check-circled"></i> Shipping</a>
        <a href="checkout-4.html"><i class="icofont-check-circled"></i> Payment</a>
        <a href="checkout-5.html"><i class="icofont-check-circled"></i> Review</a>
    </div>

    <!-- Checkout Area -->
    <div class="checkout_area section_padding_100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="checkout_details_area clearfix">
                        <h5 class="mb-4">Billing Details</h5>
                        <form action="#" method="post">
                            @php
                                if(isset($user)){
                                    $name=explode(' ',$user->full_name);
                                    }
                            @endphp
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    @if(isset($name[0]))
                                        <label for="first_name">First Name</label>
                                        <input type="text" class="form-control" id="first_name" name="first_name"  placeholder="First Name" value="{{$name[0]}}">
                                    @endif
                                </div>
                                <div class="col-md-6 mb-3">
                                    @if(isset($name[1]))
                                        <label for="last_name">Last Name</label>
                                        <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last Name" value="{{$name[1]}}">
                                    @endif
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="email_address">Email Address</label>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Email Address" value="{{$user->email}}" readonly>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="phone_number">Phone Number</label>
                                    <input type="number" class="form-control" id="phone" name="phone" min="0" value="{{$user->phone}}">
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label for="country">Country</label>
                                    <input type="text" class="form-control" id="country" name="country" value="{{$user->country}}" placeholder="eg. Nepal">
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label for="address">Address</label>
                                    <input type="text" class="form-control" name="address" id="address" placeholder="Address" value="{{$user->address}}">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="city">Town/City</label>
                                    <input type="text" class="form-control" name="city" id="city" placeholder="Town/City" value="{{$user->city}}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="state">State</label>
                                    <input type="text" class="form-control" name="state" id="state" placeholder="State" value="{{$user->state}}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="postcode">Postcode/Zip</label>
                                    <input type="text" class="form-control" id="postcode" name="postcode" placeholder="Postcode / Zip" value="{{$user->postcode}}">
                                </div>
                                <div class="col-md-12">
                                    <label for="order-notes">Order Notes</label>
                                    <textarea class="form-control" id="order-notes" cols="30" rows="10" placeholder="Notes about your order, e.g. special notes for delivery."></textarea>
                                </div>
                            </div>

                            <!-- Different Shipping Address -->
                            <div class="different-address mt-50">
                                <div class="ship-different-title mb-3">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="customCheck1">
                                        <label class="custom-control-label" for="customCheck1">Ship to your present address?</label>
                                    </div>
                                </div>
                                <div class="row shipping_input_field">
                                    <div class="col-md-6 mb-3">
                                        @if(isset($name[0]))
                                            <label for="first_name">First Name</label>
                                            <input type="text" class="form-control" id="shipping_first_name" name="shipping_first_name"  placeholder="First Name" value="{{$name[0]}}">
                                        @endif
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        @if(isset($name[1]))
                                            <label for="last_name">Last Name</label>
                                            <input type="text" class="form-control" id="shipping_last_name" name="shipping_last_name" placeholder="Last Name" value="{{$name[1]}}">
                                        @endif
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="email_address">Email Address</label>
                                        <input type="email" class="form-control" id="shipping_email" name="shipping_email" placeholder="Email Address" value="{{$user->email}}" readonly>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="phone_number">Phone Number</label>
                                        <input type="number" class="form-control" id="shipping_phone" name="shipping_phone" min="0" value="{{$user->phone}}">
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label for="country">Country</label>
                                        <input type="text" class="form-control" id="shipping_country" name="shipping_country" value="{{$user->shiping_country}}" placeholder="eg. Nepal">
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label for="address">Address</label>
                                        <input type="text" class="form-control" name="shipping_address" id="shipping_address" placeholder="Address" value="{{$user->shiping_address}}">
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="city">Town/City</label>
                                        <input type="text" class="form-control" name="shipping_city" id="city" placeholder="Town/City" value="{{$user->shiping_city}}">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="state">State</label>
                                        <input type="text" class="form-control" name="shipping_state" id="shipping_state" placeholder="State" value="{{$user->shiping_state}}">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="postcode">Postcode/Zip</label>
                                        <input type="text" class="form-control" id="shipping_postcode" name="shipping_postcode" placeholder="Postcode / Zip" value="{{$user->shiping_postcode}}">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-12">
                    <div class="checkout_pagination d-flex justify-content-end mt-50">
                        <a href="checkout-1.html" class="btn btn-primary mt-2 ml-2">Go Back</a>
                        <a href="checkout-3.html" class="btn btn-primary mt-2 ml-2">Continue</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Checkout Area -->
@endsection

@section('scripts')
    <script>
        $('#customCheck1').on('change',function (e) {
            e.preventDefault();
            if(this.checked){
                $('#shipping_first_name').val($('#first_name').val());
                $('#shipping_last_name').val($('#last_name').val());
                $('#shipping_email').val($('#email').val());
                $('#shipping_phone').val($('#phone').val());

                $('#shipping_country').val($('#country').val());
                $('#shipping_address').val($('#address').val());
                $('#shipping_state').val($('#state').val());
                $('#shipping_city').val($('#city').val());
                $('#shipping_postcode').val($('#postcode').val());
            }
            else{
                $('#shipping_first_name').val("");
                $('#shipping_last_name').val("");
                $('#shipping_email').val("");
                $('#shipping_phone').val("");

                $('#shipping_country').val("");
                $('#shipping_address').val("");
                $('#shipping_state').val("");
                $('#shipping_city').val("");
                $('#shipping_postcode').val("");

            }
        })

    </script>

@endsection
