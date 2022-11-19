@extends('backend.layouts.master')

@section('content')
<div id="main-content">
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12">
                @include('backend.layouts.notification')
            </div>
            <div class="col-lg-12">
                <div class="card">
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover">
                                <thead class="thead-dark">
                                <tr>
                                    <th>Order Number</th>
                                    <th>Address</th>
                                    <th>Sub Total</th>
                                    <th>Coupon</th>
                                    <th>condition</th>
                                    <th>Payment Method</th>
                                    <th>Payment Status</th>
                                    <th>Total Amount</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>

                                    <tr>
                                        <td>{{$order->order_number}}</td>
                                        <td>{{$order->address}}</td>
                                        <td>$ {{$order->sub_total}}</td>
                                        <td>$ {{$order->coupon}}</td>
                                        <td><span class="badge
                                            @if($order->condition=='pending')
                                                badge-info
                                            @elseif($order->condition=='processing')
                                                badge-primary
                                            @elseif($order->condition=='complete')
                                                badge-success
                                            @elseif($order->condition=='cancel')
                                                badge-danger
                                            @endif
                                                ">{{$order->condition}}</span></td>
                                        <td>{{$order->payment_method}}</td>
                                        <td>{{$order->payment_status}}</td>
                                        <td>$ {{$order->total_amount}}</td>
                                        <td>
                                            <a href="#"class="float-left btn btn-sm btn-outline-info" data-placement="bottom"><i class="fas fa-download"></i></a>
                                            <form class="float-left ml-1" action="{{route('order.destroy',$order->id)}}" method="POST">
                                                @csrf
                                                @method('delete')
                                                <button data-toggle="tooltip" title="delete" data-id=""
                                                        class="dltBtn btn btn-sm btn-outline-danger" data-placement="bottom">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                                {{-- <a href="" data-toggle="tooltip" title="delete" data-id="{{$item->id}}" class="dltBtn btn btn-sm btn-outline-danger" data-placement="bottom"><i class="fas fa-trash-alt"></i></a> --}}
                                            </form>

                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="card">
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover">
                                <thead class="thead-dark">
                                <tr>
                                    <th>S.N</th>
                                    <th>Product Image</th>
                                    <th>Product</th>
                                    <th>Quantity</th>
                                    <th>price</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($order->products as $item)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
{{--                                    <td></td>--}}
{{--                                    @php--}}
{{--                                    echo "<pre>";--}}
{{--                                    print_r($item->photo);--}}
{{--                                    echo "<pre>";--}}
{{--                                    print_r($item->title);--}}
{{--                                    echo "<pre>";--}}
{{--                                    print_r($item->pivot->quantity);--}}
{{--                                    echo "<pre>";--}}
{{--                                    print_r($item->price);--}}
{{--                                    exit();--}}
{{--                                    @endphp--}}
                                    <td><img src="{{$item->photo}}" width="100" alt=""></td>
                                    <td>{{$item->title}}</td>
                                    <td>$ {{$item->pivot->quantity}}</td>
                                    <td>{{$item->price}}</td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-5">

                        </div>
                        <div class="col-md-7">
                            <p>
                                <strong>Sub Total:</strong><span>${{number_format($order->sub_total,2)}}</span>
                            </p>
                            <p>
                                <strong>Shipping Cast:</strong><span>${{number_format($order->delivery_charge,2)}}</span>
                            </p>
                            <p>
                                <strong>Coupon:</strong><span>${{number_format($order->coupon,2)}}</span>
                            </p>
                            <p>
                                <strong>Total:</strong><span>${{number_format($order->total_amount,2)}}</span>
                            </p>

                            <br>
                            <div >
                                <form action="{{route('order.status')}}" method="POST">
                                    @csrf
                                    <input type="hidden" name="order_id" value="{{$order->id}}">
                                    <label for="">Status</label>
                                    <select class="form-control" name="condition" id="">
                                        <option value="pending"  {{$order->condition=='pending'?'selected':''}}>Pending</option>
                                        <option value="processing"  {{$order->condition=='processing'?'selected':''}}>processing</option>
                                        <option value="complete"  {{$order->condition=='complete'?'disabled selected':''}}>complete</option>
                                        <option value="cancel"  {{$order->condition=='complete'?'disabled':''}}>cancel</option>
                                    </select>
                                    <input type="submit" class="btn btn-sm btn-success" value="Submit">
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection

@section('scripts')
{{-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('.dltBtn').click(function(e)){
        var form=$(this).closest('form');
        var dataID=$(this).data('id');
        e.preventDefault();
        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this imaginary file!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
            })
        .then((willDelete) => {
        if (willDelete) {
            // form.submit();
            swal("Poof! Your imaginary file has been deleted!", {
            icon: "success",
            });
        } else {
            swal("Your imaginary file is safe!");
        }
        });
    }
</script> --}}
<script>
    $('input[name=toogle]').change(function(){
        var mode=$(this).prop('checked');
        var id=$(this).val()

        $.ajax({
            url:"{{route('brand.status')}}",
            type:"POST",
            data:{
                _token:'{{csrf_token()}}',
                mode:mode,
                id:id,
            },
            success:function(response){
                if(response.status){
                    alert(response.msg);
                }
                else{
                    alert('please try again');
                }
            }
        })
    });
</script>
@endsection
