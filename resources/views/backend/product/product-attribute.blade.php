@extends('backend.layouts.master')

@section('content')
    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-6 col-md-8 col-sm-12">
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth">
                                <i class="fa fa-arrow-left"></i></a>Product Attribute</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin')}}"><i class="icon-home"></i></a></li>
                            <li class="breadcrumb-item active">Product Attribute</li>
                        </ul>
                    </div>


                </div>
            </div>

            <div class="row clearfix">
                <div class="col-md-12">
                    @include('backend.layouts.notification')

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{$error}}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
                <div class="col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h3>{{$product->title}}</h3>
                        </div>
                        <div class="body">
                            <form action="{{route('product.attribute',$product->id)}}" method="POST">
                                @csrf
                                <div id="product-attribute" class="content" data-mfield-options='{"section": ".group","btnAdd":"#btnAdd-1","btnRemove":".btnRemove"}'>
                                <div class="row">
                                    <div class="col-md-12 py-2"><button type="button" id="btnAdd-1" class="btn btn-sm btn-primary"><i class="fa fa-plus-circle"></i></button></div>
                                </div>
                                <div class="row group">
                                    <div class="col-md-2">
                                        <label for="">Size</label>
                                        <input class="form-control form-control-sm text-uppercase" name="size[]" placeholder="eg. S,M,L,XL" type="text">
                                    </div>
                                    <div class="col-md-2">
                                        <label for="">Original Price</label>
                                        <input class="form-control form-control-sm" name="original_price[]" placeholder="eg. 500" step="any" type="number">
                                    </div>
                                    <div class="col-md-2">
                                        <label for="">Offer price</label>
                                        <input class="form-control form-control-sm" name="offer_price[]" placeholder="eg. 100" step="any" type="number">
                                    </div>
                                    <div class="col-md-2">
                                        <label for="">Stock</label>
                                        <input class="form-control form-control-sm" name="stock[]" placeholder="eg. 100" step="any" type="number">
                                    </div>
                                    <div class="col-md-1 mt-4 p-1">
                                        <button type="button" class="btn btn-sm btn-danger btnRemove"><i class="fas fa-trash-alt"></i></button>
                                    </div>
                                </div>
                            </div>
                                <button type="submit" class="btn btn-success">submit</button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="card">
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                    <tr>
                                        <th>Sr.No.</th>
                                        <th>Size</th>
                                        <th>Originl Price</th>
                                        <th>Offer Price</th>
                                        <th>stock</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody >
                                    @if(count($productAttribute)>0)
                                        @foreach ($productAttribute as $item)
                                            <tr>
                                                <td>{{$loop->iteration}}</td>
                                                <td>{{$item->size}}</td>
                                                <td>${{number_format($item->original_price,2)}}</td>
                                                <td>{{number_format($item->offer_price,0)}}</td>
                                                <td>{{$item->stock}}</td>
                                                <td>
                                                    <form class="float-left ml-1" action="{{route('product.attribute.destroy',$item->id)}}" method="POST">
                                                        @csrf
                                                        @method('delete')
                                                        <button data-toggle="tooltip" title="delete" data-id="{{$item->id}}"
                                                                class="dltBtn btn btn-sm btn-outline-danger" data-placement="bottom">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
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
    <script src="{{asset('backend/assets/js/jquery.multifield.min.js')}}"></script>
    <script>
        $('#product-attribute').multifield();
    </script>
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
                url:"{{route('product.status')}}",
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

