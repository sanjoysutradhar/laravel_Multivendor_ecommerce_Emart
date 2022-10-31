<div class="col-12">
    <div class="cart-table">
        <div class="table-responsive" >
            {{--                            @include('frontend.layouts._cart-lists')--}}
            <table class="table table-bordered mb-30">
                <thead>
                <tr>
                    <th scope="col"><i class="icofont-ui-delete"></i></th>
                    <th scope="col">Image</th>
                    <th scope="col">Product</th>
                    <th scope="col">Unit Price</th>
                    <th scope="col">Quantity</th>
                    <th scope="col  ">Total</th>
                </tr>
                </thead>
                <tbody>
                @foreach(\Gloudemans\Shoppingcart\Facades\Cart::instance('shopping')->content() as $item)
                    <tr>
                        <th scope="row" >
                            <i class="icofont-close " id="cart_delete" data-id="{{$item->rowId}}"></i>
                        </th>
                        <td>
                            {{--                                        <img src="img/product-img/onsale-1.png" alt="Product">--}}
                            @php
                                $photos=explode(',',$item->model->photo);
                            @endphp
                            @if(isset($photos[0]))
                                <img src="{{$photos[0]}}" class="cart-thumb" alt="">
                            @endif
                        </td>
                        <td>
                            <a href="{{route('product.detail',$item->model->slug)}}">{{$item->name}}</a>
                        </td>
                        <td>${{$item->price}}</td>
                        <td>
                            <div class="quantity">
                                <input type="number" class="qty-text" data-id="{{$item->rowId}}" id="qty-input-{{$item->rowId}}" step="1" min="1" max="99" name="quantity" value="{{$item->qty}}">
                                <input type="hidden" data-id="{{$item->rowId}}" data-product-quantity="{{$item->model->stock}}" id="update-cart-{{$item->rowId}}"/>
                            </div>
                        </td>
                        <td>{{$item->subtotal()}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="col-12 col-lg-6">
    <div class="cart-apply-coupon mb-30">
        <h6>Have a Coupon?</h6>
        <p>Enter your coupon code here &amp; get awesome discounts!</p>
        <!-- Form -->
        <div class="coupon-form">
            <form action="{{route('coupon.add')}}" id="coupon-form" method="POST">
                @csrf
                <input type="text" name="code" class="form-control" placeholder="Enter Your Coupon Code">
                <button type="submit" class="coupon-btn btn btn-primary">Apply Coupon</button>
            </form>
        </div>
    </div>
</div>

<div class="col-12 col-lg-5">
    <div class="cart-total-area mb-30">
        <h5 class="mb-3">Cart Totals</h5>
        <div class="table-responsive">
            <table class="table mb-3">
                <tbody>
                <tr>
                    <td>Sub Total</td>
                    <td>${{\Gloudemans\Shoppingcart\Facades\Cart::subtotal()}}</td>
                </tr>
                <tr>
                    <td>Save amount</td>
                    <td>$ @if(\Illuminate\Support\Facades\Session::has('coupon')) {{number_format(\Illuminate\Support\Facades\Session::get('coupon')['value'])}} @else 0 @endif</td>
                </tr>
                <tr>
                    <td>Total</td>
                    @if(\Illuminate\Support\Facades\Session::has('coupon'))
                        <td>$ {{number_format((float) str_ireplace(',','',\Gloudemans\Shoppingcart\Facades\Cart::subtotal())-\Illuminate\Support\Facades\Session::get('coupon')['value'],2)}}  </td>
                    @else
                        <td>${{\Gloudemans\Shoppingcart\Facades\Cart::subtotal()}}</td>
                    @endif
                </tr>
                </tbody>
            </table>
        </div>
        {{--                            <a href="{{route('checkout1')}}" class="btn btn-primary d-block">Proceed To Checkout</a>--}}
        <button type="button" data-value="{{count(\Gloudemans\Shoppingcart\Facades\Cart::instance('shopping')->content())}}" class="btn btn-primary d-block procees_to_checkout">Proceed To Checkout</button>

    </div>
</div>
