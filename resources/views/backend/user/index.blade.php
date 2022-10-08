@extends('backend.layouts.master')

@section('content')
<div id="main-content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-6 col-md-8 col-sm-12">
                    <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> User</h2>
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
                                <thead>
                                    <tr>
                                        <th>Sr.No.</th>
                                        <th>Full Name</th>
                                        <th>UserName</th>
                                        <th>Email</th>
                                        <th>Photo</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>                            
                                <tbody>
                                    @foreach ($users as $item)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$item->full_name}}</td>
                                        <td>{{$item->username}}</td>
                                        <td>{{$item->email}}</td>
                                        <td><img src="{{$item->photo}}" alt="banner image" height="100px" width="75px"></td>
                                        
                                        <td>
                                            <input type="checkbox" name="toogle" value="{{$item->id}}" data-toggle="switchbutton" {{$item->status=='active' ? 'checked' : '' }} data-onlabel="active" data-offlabel="inactive"
                                             data-size="sm" data-onstyle="success" data-offstyle="danger">
                                        </td>
                                        <td>
                                            <a href="javascript:void(0);" data-toggle="modal" data-target="#productID{{$item->id}}" title="view" 
                                                class="float-left btn btn-sm btn-outline-secondary" data-placement="bottom"><i class="fas fa-eye"></i></a>
                                            <a href="{{route('user.edit',$item->id)}}" data-toggle="tooltip" title="edit" class="float-left btn btn-sm btn-outline-warning" data-placement="bottom"><i class="fas fa-edit"></i></a>
                                            <form class="float-left ml-1" action="{{route('user.destroy',$item->id)}}" method="POST">
                                                @csrf
                                                @method('delete')
                                                <button data-toggle="tooltip" title="delete" data-id="{{$item->id}}" class="dltBtn btn btn-sm btn-outline-danger" data-placement="bottom">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                                {{-- <a href="" data-toggle="tooltip" title="delete" data-id="{{$item->id}}" class="dltBtn btn btn-sm btn-outline-danger" data-placement="bottom"><i class="fas fa-trash-alt"></i></a> --}}
                                            </form>
                                            
                                        </td>
                                        {{-- modal --}}
                                        <div class="modal fade" id="productID{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                              @php
                                                  $users=\App\Models\User::where('id',$item->id)->first();
                                              @endphp
                                                <div class="modal-content">
                                                <div class="modal-header">
                                                  <h5 class="modal-title" id="exampleModalLongTitle">{{\Illuminate\Support\Str::upper($users->full_name)}}</h5>
                                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                  </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <img src="{{$users->photo}}" alt="banner image" height="200px" width="155px">
                                                        </div>
                                                    </div>
                                                    <strong>UserName:</strong>
                                                    <p>{!! html_entity_decode($users->username)!!}</p>
                                                    <strong>Phone:</strong>
                                                    <p>{!! html_entity_decode($users->phone)!!}</p>
                                                    
                                                    
                                                   
                                                   
                                                    <strong>Email:</strong>
                                                    <p>{{$users->email}}</p>
                                                
                                                    <strong>Address:</strong>
                                                    <p>{{$users->address}}</p>
                                                   
                                                    
                                                    
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <strong>Role:</strong>
                                                            <p class="badge badge-success">{{$users->role}}</p>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <strong>Status:</strong>
                                                            <p class="badge badge-primary">{{$users->status}}</p>
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
            url:"{{route('user.status')}}",
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