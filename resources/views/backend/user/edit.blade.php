@extends('backend.layouts.master')
@section('content')
<div id="main-content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-6 col-md-8 col-sm-12">
                    <h2><a href="javascript:void(0);" 
                        class="btn btn-xs btn-link btn-toggle-fullwidth">
                        <i class="fa fa-arrow-left"></i></a>Add Users</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('admin')}}"><i class="icon-home"></i></a></li>                            
                        <li class="breadcrumb-item">Users</li>
                        <li class="breadcrumb-item active">Add Users</li>
                    </ul>
                </div>            
               
            </div>
        </div>
        
        <div class="row clearfix">
            <div class="col-md-12">
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
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <div class="header">
                        <h2><strong>Basic</strong> Information <small>Description text here...</small> </h2>
                        <ul class="header-dropdown">
                            <li class="dropdown"> <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"></a>
                                <ul class="dropdown-menu dropdown-menu-right slideUp">
                                    <li><a href="javascript:void(0);" class="waves-effect waves-block">Action</a></li>
                                    <li><a href="javascript:void(0);" class="waves-effect waves-block">Another action</a></li>
                                    <li><a href="javascript:void(0);" class="waves-effect waves-block">Something else</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="body">
                        <form action="{{route('user.update',$users->id)}}" method="POST">
                            @csrf
                            @method('patch')
                            <div class="row clearfix">
                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <label for="">Full Name<span class="text-danger">*</span></label>
                                        <input type="text" name="full_name" class="form-control" value="{{$users->full_name}}" placeholder="full name">
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <label for="">User Name<span class="text-danger">*</span></label>
                                        <input type="text" name="username" class="form-control" value="{{$users->username}}" placeholder="user name">
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <label for="">Email<span class="text-danger">*</span></label>
                                        <input type="email" name="email" class="form-control"
                                         value="{{$users->email}}" placeholder="Email">
                                    </div>
                                </div>
                                {{-- <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <label for="">Password<span class="text-danger">*</span></label>
                                        <input type="password" name="password" class="form-control"
                                         value="{{old('password')}}" placeholder="Password">
                                    </div>
                                </div> --}}
                               
                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <label for="">Phone Number<span class="text-danger">*</span></label>
                                        <input type="text" name="phone" class="form-control"
                                         value="{{$users->phone}}" placeholder="Phone Number">
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <label for="">Address<span class="text-danger">*</span></label>
                                        <input type="text" name="address" class="form-control"
                                         value="{{$users->address}}" placeholder="Address">
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <label for="">Image</label>
                                        <div class="input-group">
                                            <span class="input-group-btn">
                                              <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                                                <i class="fa fa-picture-o"></i> Choose
                                              </a>
                                            </span>
                                            <input id="thumbnail" class="form-control" type="text" value="{{$users->photo}}" name="photo">
                                          </div>
                                          <div id="holder" style="margin-top:15px;max-height:100px;"></div>
                                    </div>
                                </div>
            
                                
    
                                <div class="col-lg-12 col-md-12 col-sm-12"> 
                                    <label for="">Role<span class="text-danger">*</span></label>                               
                                    <select name="role" class="form-control show-tick">
                                        <option value="">-- Role --</option>
                                        <option value="admin" {{$users->role=='admin'?'selected': ''}}>Admin</option>
                                        <option value="vendor" {{$users->role=='vendor'?'selected': ''}}>Vendor</option>
                                        <option value="customer" {{$users->role=='customer'?'selected': ''}}>Customer</option>
                                    </select>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12">                                
                                    <select name="status" class="form-control show-tick">
                                        <option value="">-- status --</option>
                                        <option value="active" {{$users->status=='active'?'selected': ''}}>Active</option>
                                        <option value="inactive" {{$users->status=='inactive'?'selected': ''}}>inactive</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-seccess">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection

@section('scripts')
<script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
<script>
    $('#lfm').filemanager('image');
</script>
<script>
    $(document).ready(function() {
        $('#description').summernote();
    });
</script>
@endsection