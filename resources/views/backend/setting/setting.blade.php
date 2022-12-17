@extends('backend.layouts.master')
@section('content')
    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-6 col-md-8 col-sm-12">
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a>Edit Settings</h2>
                    </div>

                </div>
            </div>

            <div class="row clearfix">
                <div class="col-lg-12">
                    @include('backend.layouts.notification')
                </div>
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
                            <form action="{{route('setting.update',$setting->id)}}" method="POST">
                                @csrf
                                <div class="row clearfix">
                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group">
                                            <label for="">Title<span class="text-danger">*</span></label>
                                            <input type="text" name="title" class="form-control" value="{{$setting->title}}" placeholder="title">
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group">
                                            <label for="">Meta Description</label>
                                            <textarea id="meta_description" name="meta_description" class="form-control" placeholder="Write some text....">{{$setting->meta_description}}</textarea>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group">
                                            <label for="">Meta Keywords<span class="text-danger">*</span></label>
                                            <input type="text" name="meta_keywords" class="form-control" value="{{$setting->meta_keywords}}" placeholder="meta keywords">
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <label for="">Logo</label>
                                            <div class="input-group">
                                            <span class="input-group-btn">
                                              <a id="lfm_logo" data-input="thumbnail_logo" data-preview="holder" class="btn btn-primary">
                                                <i class="fa fa-picture-o"></i> Choose
                                              </a>
                                            </span>
                                                <input id="thumbnail_logo" class="form-control" type="text" name="logo" value="{{$setting->logo}}">
                                            </div>
                                            <div id="holder" style="margin-top:15px;max-height:100px;"></div>
                                            <img src="{{asset($setting->logo)}}" alt="" width="100" height="100">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <label for="">Favicon</label>
                                            <div class="input-group">
                                            <span class="input-group-btn">
                                              <a id="lfm_favicon" data-input="thumbnail_favicon" data-preview="holder1" class="btn btn-primary">
                                                <i class="fa fa-picture-o"></i> Choose
                                              </a>
                                            </span>
                                                <input id="thumbnail_favicon" class="form-control" type="text" name="favicon" value="{{$setting->favicon}}">
                                            </div>
                                            <div id="holder1" style="margin-top:15px;max-height:100px;"></div>
                                            <img src="{{asset($setting->favicon)}}" alt="" width="100" height="100">
                                        </div>
                                    </div>

                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group">
                                            <label for="">Address<span class="text-danger">*</span></label>
                                            <input type="text" name="address" class="form-control" value="{{$setting->address}}" placeholder="Address">
                                        </div>
                                    </div>

                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group">
                                            <label for="">Email<span class="text-danger">*</span></label>
                                            <input type="email" name="email" class="form-control" value="{{$setting->email}}" placeholder="Email">
                                        </div>
                                    </div>

                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group">
                                            <label for="">Phone<span class="text-danger">*</span></label>
                                            <input type="text" name="phone" class="form-control" value="{{$setting->phone}}" placeholder="Phone">
                                        </div>
                                    </div>

                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group">
                                            <label for="">Fax<span class="text-danger">*</span></label>
                                            <input type="text" name="fax" class="form-control" value="{{$setting->fax}}" placeholder="Address">
                                        </div>
                                    </div>

                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group">
                                            <label for="">Footer<span class="text-danger">*</span></label>
                                            <input type="text" name="footer" class="form-control" value="{{$setting->footer}}" placeholder="Footer">
                                        </div>
                                    </div>


{{--                                    Url--}}

                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <label for="">Facebook Url<span class="text-danger">*</span></label>
                                            <input type="text" name="facebook_url" class="form-control" value="{{$setting->facebook_url}}" placeholder="Facebook Url">
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <label for="">Twitter Url<span class="text-danger">*</span></label>
                                            <input type="text" name="twitter_url" class="form-control" value="{{$setting->twitter_url}}" placeholder="Twitter Url">
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <label for="">Linked Url<span class="text-danger">*</span></label>
                                            <input type="text" name="linked_url" class="form-control" value="{{$setting->linked_url}}" placeholder="Linked Url">
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <label for="">Pinterest Url<span class="text-danger">*</span></label>
                                            <input type="text" name="pinterest_url" class="form-control" value="{{$setting->pinterest_url}}" placeholder="Pinterest Url">
                                        </div>
                                    </div>

                                </div>

                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    <button type="submit" class="btn btn-outline-secondary">Cancel</button>
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
        $('#lfm_logo').filemanager('image');
        $('#lfm_favicon').filemanager('image');
    </script>
    <script>
        $(document).ready(function() {
            $('#description').summernote();
        });
    </script>
@endsection
