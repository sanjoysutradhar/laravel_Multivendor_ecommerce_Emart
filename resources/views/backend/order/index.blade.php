@extends('backend.layouts.master')

@section('content')
<div id="main-content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-6 col-md-8 col-sm-12">
                    <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth">
                        <i class="fa fa-arrow-left"></i></a> Order</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('admin')}}"><i class="icon-home"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="row clearfix">
            <div class="col-lg-12">
                @include('backend.layouts.notification')
            </div>
            <div class="col-lg-12">
                <div class="card">
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                <thead class="thead-dark">
                                <tr>
                                    <th style="width:60px;">#</th>
                                    <th>Order Number</th>
                                    <th>Address</th>
                                    <th>Sub Total</th>
                                    <th>Coupon</th>
                                    <th>condition</th>
                                    <th>Payment Method</th>
                                    <th>Total Amount</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($orders as $item)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$item->order_number}}</td>
                                        <td>{{$item->address}}</td>
                                        <td>$ {{$item->sub_total}}</td>
                                        <td>$ {{$item->coupon}}</td>
                                        <td><span class="badge
                                            @if($item->condition=='pending')
                                                badge-info
                                            @elseif($item->condition=='processing')
                                                badge-primary
                                            @elseif($item->condition=='complete')
                                                badge-success
                                            @elseif($item->condition=='cancel')
                                                badge-danger
                                            @endif
                                                ">{{$item->condition}}</span></td>
                                        <td>{{$item->payment_method}}</td>
                                        <td>$ {{$item->total_amount}}</td>
                                        <td>
                                            <a href="{{route('order.show',$item->id)}}"class="float-left btn btn-sm btn-outline-info" data-placement="bottom"><i class="fas fa-eye"></i></a>
                                            <form class="float-left ml-1" action="{{route('order.destroy',$item->id)}}" method="POST">
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
                                @endforeach

                                </tbody>
                            </table>
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
