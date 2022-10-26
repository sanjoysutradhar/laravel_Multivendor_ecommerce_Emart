<table class="table table-bordered mb-30">
    <thead>
    <tr>
        <th scope="col"><i class="icofont-ui-delete"></i></th>
        <th scope="col">Image</th>
        <th scope="col">Product</th>
        <th scope="col">Unit Price</th>

        <th scope="col"></th>
    </tr>
    </thead>
    <tbody>
    @if(\Gloudemans\Shoppingcart\Facades\Cart::instance('wishlist')->count()>0)
        @foreach(\Gloudemans\Shoppingcart\Facades\Cart::instance('wishlist')->content() as $item)
            <tr>
                <th scope="row">
                    <i class="icofont-close delete_wishlist" data-id="{{$item->rowId}}"></i>
                </th>
                <td>
                    @php
                        $photos=explode(',',$item->model->photo);
                    @endphp
                    @if(isset($photos[0]))
                        <img src="{{$photos[0]}}" class="cart-thumb" alt="product">
                    @endif
                </td>
                <td>
                    <a href="{{route('product.detail',$item->model->slug)}}">{{$item->name}}</a>
                </td>
                <td>${{number_format($item->price,2)}}</td>
                <td><a href="javascript:void(0)" data-id="{{$item->rowId}}" class="move_to_cart btn btn-primary btn-sm">Add to Cart</a></td>
            </tr>
        @endforeach
    @else
        <tr>
            <td colspan="4" class="text-center">You don't have any wishlist product!</td>
        </tr>
        <p>You don't have any wishlist product!</p>
    @endif

    </tbody>
</table>
