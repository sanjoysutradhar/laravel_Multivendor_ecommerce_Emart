@extends('backend.layouts.master')
@section('content')
<div id="main-content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-6 col-md-8 col-sm-12">
                    <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a>Add Currencies</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('admin')}}"><i class="icon-home"></i></a></li>                            
                        <li class="breadcrumb-item">Currencies</li>
                        <li class="breadcrumb-item active">Add Currencies</li>
                    </ul>
                </div>            
               
            </div>
        </div>
        
        <div class="row clearfix">
            <div class="col-md-12">
                {{-- @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
                @endif --}}
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
                        <form action="{{route('currency.update',$currency->id)}}" method="POST">
                            @csrf
                            @method('PATCH')
                            <div class="row clearfix">
                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <label for="">Name<span class="text-danger">*</span></label>
                                        <input type="text" name="name" class="form-control" value="{{$currency->name}}" placeholder="name">
                                    </div>
                                    @error('name')
                                    <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>
                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <label for="">Symbol<span class="text-danger">*</span></label>
                                        <input type="text" name="symbol" class="form-control" value="{{$currency->symbol}}" placeholder="Symbol">
                                    </div>
                                    @error('symbol')
                                    <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>

                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <label for="">Exchange Rate<span class="text-danger">*</span></label>
                                        <input type="number" name="exchange_rate" class="form-control" value="{{$currency->exchange_rate}}" placeholder="Exchange Rate">
                                    </div>
                                    @error('exchange_rate')
                                    <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>
                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <label for="">Code<span class="text-danger">*</span></label>
                                        <input type="text" name="code" class="form-control" value="{{old($currency->code)}}" placeholder="Code">
                                    </div>
                                    @error('code')
                                    <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>
    
                                
                                <div class="col-lg-12 col-md-12 col-sm-12">                                
                                    <select name="status" class="form-control show-tick">
                                        <option value="">-- status --</option>
                                        <option value="active" {{$currency->status=='active'?'selected': ''}}>Active</option>
                                        <option value="inactive" {{$currency->status=='inactive'?'selected': ''}}>Inactive</option>
                                    </select>
                                </div>
                            </div>
    
                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-primary">Update</button>
                                <a href="{{route('currency.index')}}" class="btn btn-outline-secondary">Cancel</a>
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