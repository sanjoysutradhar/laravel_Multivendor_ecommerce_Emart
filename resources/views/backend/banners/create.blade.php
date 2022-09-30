@extends('backend.layouts.master')
@section('content')
<div id="main-content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-6 col-md-8 col-sm-12">
                    <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a>Add Banners</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('admin')}}"><i class="icon-home"></i></a></li>                            
                        <li class="breadcrumb-item">Banners</li>
                        <li class="breadcrumb-item active">Add Banners</li>
                    </ul>
                </div>            
               
            </div>
        </div>
        
        <div class="row clearfix">
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
                        <div class="row clearfix">
                            <div class="col-lg-12 col-md-12">
                                <div class="form-group">
                                    <label for="">Title<span class="text-danger">*</span></label>
                                    <input type="text" name="title" class="form-control" value="{{old('title')}}" placeholder="title">
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
                                        <input id="thumbnail" class="form-control" type="text" name="filepath">
                                      </div>
                                      <div id="holder" style="margin-top:15px;max-height:100px;"></div>
                                </div>
                            </div>
        
                            <div class="col-lg-12 col-md-12">
                                <div class="form-group">
                                    <label for="">Description</label>
                                    <textarea id="description" name="description" class="form-control" placeholder="Write some text....">{{old('description')}}</textarea>
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-12 col-sm-12"> 
                                <label for="">Condition</label>                               
                                <select name="condition" class="form-control show-tick">
                                    <option value="">-- Conditions --</option>
                                    <option value="banner" {{old('condition')=='banner'?'selected': ''}}>Banner</option>
                                    <option value="promo" {{old('condition')=='promo'?'selected': ''}}>Promote</option>
                                </select>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12">                                
                                <select name="status" class="form-control show-tick">
                                    <option value="">-- status --</option>
                                    <option value="active" {{old('status')=='active'?'selected': ''}}>Active</option>
                                    <option value="inactive" {{old('status')=='inactive'?'selected': ''}}>inactive</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <button type="submit" class="btn btn-outline-secondary">Cancel</button>
                        </div>
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