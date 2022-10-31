<div class="col-12">
    <div class="checkout_details_area clearfix">
        <h5 class="mb-30">Review Your Order</h5>
        <div class="cart-table">
            <div class="table-responsive">
                <table class="table table-bordered mb-30">
                    <thead>
                    <tr>
                        <th scope="col"><i class="icofont-ui-delete"></i></th>
                        <th scope="col">Image</th>
                        <th scope="col">Product</th>
                        <th scope="col">Unit Price</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Total</th>
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
</div>

<div class="col-12 col-lg-7 ml-auto">
    <div class="cart-total-area">
        <h5 class="mb-3">Cart Totals</h5>
        <div class="table-responsive">
            <table class="table mb-0">
                <tbody>
                <tr>
                    <td>Sub Total</td>
                    <td>${{$sub_total}}</td>
                </tr>
                <tr>
                    <td>Coupon</td>
                    <td>${{number_format($coupon_value,2)}}</td>
                    {{--                                    <td>$ @if(\Illuminate\Support\Facades\Session::has('coupon')) {{number_format(\Illuminate\Support\Facades\Session::get('coupon')['value'])}} @else 0 @endif</td>--}}
                </tr>
                <tr>
                    <td>Shipping</td>
                    {{--                                    @foreach(\Illuminate\Support\Facades\Session::get('checkout') as $key=>$item)--}}
                    <td>${{number_format($delivery_charge,2)}}</td>
                    {{--                                    @endforeach--}}
                </tr>
                <tr>
                    <td>Total</td>
                    <td>${{number_format(($sub_total + $delivery_charge - $coupon_value),2)}}</td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="checkout_pagination d-flex justify-content-end mt-3">
            <a href="checkout-4.html" class="btn btn-primary mt-2 ml-2 d-none d-sm-inline-block">Go Back</a>
            <a href="{{route('checkout.store')}}" class="btn btn-primary mt-2 ml-2">Confirm</a>
        </div>
    </div>
</div>
