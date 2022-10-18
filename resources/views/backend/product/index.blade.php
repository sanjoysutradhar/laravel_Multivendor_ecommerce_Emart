@extends('backend.layouts.master')

@section('content')
<div id="main-content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-6 col-md-8 col-sm-12">
                    <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth">
                        <i class="fa fa-arrow-left"></i></a>Product</h2>
                    <a href="{{route('product.create')}}" class="btn btn-sm btn-outline-secondary">
                        <i class="icon-plus"></i>Product create</a>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('admin')}}"><i class="icon-home"></i></a></li>
                        <li class="breadcrumb-item active">Product</li>
                    </ul>
                </div>
                <div class="float-right">
                    <p class="float-right">Total Products: {{\App\Models\Product::count()}}</p>
                </div>

            </div>
        </div>

        <div class="row clearfix">
            <div class="col-md-12">
                @include('backend.layouts.notification')
            </div>
            <div class="col-lg-12">
                <div class="card">
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                <thead>
                                    <tr>
                                        <th>Sr.No.</th>
                                        <th>Title</th>
                                        {{-- <th>Summary</th>
                                        <th>Description</th> --}}
                                        {{-- <th>Stock</th> --}}
                                        <th>Photo</th>
                                        <th>Price</th>
                                        {{-- <th>Offer Price</th> --}}
                                        <th>Discount</th>
                                        <th>Size</th>
                                        <th>Condition</th>
                                        {{-- <th>Brand Id</th>
                                        <th>Vendor Id</th>
                                        <th>Catgory Id</th>
                                        <th>Child Catgory Id</th> --}}
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody >
                                    @foreach ($products as $item)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td><p style="width: 150px; overflow: scroll">{{$item->title}}</p></td>
                                        {{-- <td>{{$item->description}}</td> --}}
                                        @php
                                            $photos=explode(',',$item->photo)
                                        @endphp

                                        <td><img src="{{$photos[0]}}" alt="product image" height="100px" width="75px"></td>

                                        <td>${{number_format($item->price,2)}}</td>
                                        <td>{{number_format($item->discount,0)}}%</td>
                                        <td>
                                            @if($item->size=='S')
                                                <span class="badge badge-success">Small</span>
                                            @elseif($item->size=='M')
                                                <span class="badge badge-primary">Medium</span>
                                            @elseif($item->size=='L')
                                                <span class="badge badge-info">Large</span>
                                            @else
                                                <span class="badge badge-warning">Extra Large</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($item->condition=='new')
                                                <span class="badge badge-success">{{$item->condition}}</span>
                                            @elseif($item->condition=='popular')
                                                <span class="badge badge-primary">{{$item->condition}}</span>
                                            @else
                                                <span class="badge badge-warning">{{$item->condition}}</span>
                                            @endif
                                        </td>
                                        <td>
                                            <input type="checkbox" name="toogle" value="{{$item->id}}"
                                            data-toggle="switchbutton" {{$item->status=='active' ? 'checked' : '' }}
                                            data-onlabel="active" data-offlabel="inactive"
                                             data-size="sm" data-onstyle="success" data-offstyle="danger">
                                        </td>
                                        <td>
                                            <a href="javascript:void(0);" data-toggle="modal" data-target="#productID{{$item->id}}" title="view"
                                                class="float-left btn btn-sm btn-outline-secondary" data-placement="bottom"><i class="fas fa-eye"></i></a>
                                                <a href="{{route('product.edit',$item->id)}}" data-toggle="tooltip" title="edit"
                                                    class="float-left btn btn-sm btn-outline-warning" data-placement="bottom"><i class="fas fa-edit"></i></a>
                                                <form class="float-left ml-1" action="{{route('product.destroy',$item->id)}}" method="POST">
                                                @csrf
                                                @method('delete')
                                                <button data-toggle="tooltip" title="delete" data-id="{{$item->id}}"
                                                    class="dltBtn btn btn-sm btn-outline-danger" data-placement="bottom">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                                {{-- <a href="" data-toggle="tooltip" title="delete" data-id="{{$item->id}}" class="dltBtn btn btn-sm btn-outline-danger" data-placement="bottom"><i class="fas fa-trash-alt"></i></a> --}}
                                            </form>


                                        </td>
                                        {{-- modal --}}
                                        <div class="modal fade" id="productID{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                              @php
                                                  $product=\App\Models\Product::where('id',$item->id)->first();
                                              @endphp
                                                <div class="modal-content">
                                                <div class="modal-header">
                                                  <h5 class="modal-title" id="exampleModalLongTitle">{{\Illuminate\Support\Str::upper($product->title)}}</h5>
                                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                  </button>
                                                </div>
                                                <div class="modal-body">
                                                    <strong>Summary:</strong>
                                                    <p>{!! html_entity_decode($product->summary)!!}</p>
                                                    <strong>Description:</strong>
                                                    <p>{!! html_entity_decode($product->description)!!}</p>

                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <strong>Stock:</strong>
                                                            <p>{{ number_format($product->stock)}}</p>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <strong>Price:</strong>
                                                            <p>${{ number_format($product->price)}}</p>

                                                        </div>
                                                        <div class="col-md-4">
                                                            <strong>Offer Price:</strong>
                                                            <p>${{ number_format($product->offer_price)}}</p>
                                                        </div>
                                                    </div>

                                                    <strong>Discount:</strong>
                                                    <p>{{$product->discount}}%</p>

                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <strong>Category:</strong>
                                                            <p>{{\App\Models\Category::where('id',$product->cat_id)->value('title')}}</p>

                                                        </div>
                                                        <div class="col-md-6">
                                                            <strong>child category</strong>
                                                            <p>{{\App\Models\Category::where('id',$product->child_cat_id)->value('title')}}</p>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <strong>Brand:</strong>
                                                            <p>{{\App\Models\Brand::where('id',$product->brand_id)->value('title')}}</p>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <strong>Size:</strong>
                                                            <p class="badge badge-success">{{$product->size}}</p>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <strong>Status:</strong>
                                                            <p class="badge badge-primary">{{$product->status}}</p>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <strong>Condition:</strong>
                                                            <p class="badge badge-success">{{$product->condition}}</p>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="modal-footer">
                                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                  {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
                                                </div>
                                              </div>
                                            </div>
                                          </div>
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
