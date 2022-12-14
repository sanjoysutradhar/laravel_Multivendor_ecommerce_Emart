@extends('backend.layouts.master')
@section('content')
<div id="main-content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-6 col-md-8 col-sm-12">
                    <h2><a href="javascript:void(0);"
                        class="btn btn-xs btn-link btn-toggle-fullwidth">
                        <i class="fa fa-arrow-left"></i></a>Add Products</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('admin')}}">
                            <i class="icon-home"></i></a></li>
                        <li class="breadcrumb-item">Products</li>
                        <li class="breadcrumb-item active">Add Products</li>
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
                        <form action="{{route('product.store')}}" method="POST">
                            @csrf
                            <div class="row clearfix">
                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <label for="">Title<span class="text-danger">*</span></label>
                                        <input type="text" name="title" class="form-control" value="{{old('title')}}" placeholder="title">
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <label for="">Summary<span class="text-danger">*</span></label>
                                        <textarea name="summary" class="form-control" id="summary" cols="2" rows="2"
                                        placeholder="Some text...">{{old('summary')}}</textarea>

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
                                            <input id="thumbnail" class="form-control" type="text" name="photo">
                                          </div>
                                          <div id="holder" style="margin-top:15px;max-height:100px;"></div>
                                    </div>
                                </div>

                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <label for="">Size guide</label>
                                        <div class="input-group">
                                            <span class="input-group-btn">
                                              <a id="lfm1" data-input="thumbnail1" data-preview="holder1" class="btn btn-primary">
                                                <i class="fa fa-picture-o"></i> Choose
                                              </a>
                                            </span>
                                            <input id="thumbnail1" class="form-control" type="text" name="size_guide">
                                        </div>
                                        <div id="holder1" style="margin-top:15px;max-height:100px;"></div>
                                    </div>
                                </div>

                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <label for="">Description</label>
                                        <textarea id="description" name="description" class="description form-control" placeholder="Write some text....">{{old('description')}}</textarea>
                                    </div>
                                </div>

                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <label for="">Additional Information</label>
                                        <textarea id="description" name="additional_info" class="description form-control" placeholder="Write some text....">{{old('additional_info')}}</textarea>
                                    </div>
                                </div>

                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <label for="">Return cancellation</label>
                                        <textarea id="description" name="return_cancellation" class="description form-control" placeholder="Write some text....">{{old('return_cancellation')}}</textarea>
                                    </div>
                                </div>

                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <label for="">Stock<span class="text-danger">*</span></label>
                                        <input type="number" name="stock" class="form-control" value="{{old('stock')}}" placeholder="stock">
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <label for="">Discount<span class="text-danger">*</span></label>
                                        <input type="number" min="0" max="100" name="discount" class="form-control" value="{{old('discount')}}" placeholder="Discount">
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <label for="">Price<span class="text-danger">*</span></label>
                                        <input type="number" step="any" name="price" class="form-control" value="{{old('price')}}" placeholder="price">
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <label for="">Brand</label>
                                    <select name="brand_id" class="form-control show-tick">
                                        <option value="">-- Brand --</option>
                                        @foreach(\App\Models\Brand::get() as $brand)
                                            <option value="{{$brand->id}}" {{old(('brand_id')==$brand->id? 'selected':'')}}>{{$brand->title}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <label for="">Category</label>
                                    <select id="cat_id" name="cat_id" class="form-control show-tick">
                                        <option value="">-- Category --</option>
                                        @foreach(\App\Models\Category::where('is_parent',1)->get() as $category)
                                            <option value="{{$category->id}}" {{old(('cat_id')==$category->id? 'selected':'')}}>{{$category->title}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-lg-12 col-md-12 col-sm-12 d-none" id="child_cat_div">
                                    <label for="">Child Category</label>
                                    <select name="child_cat_id" id="child_cat_id" class="form-control show-tick">

                                    </select>
                                </div>

                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <label for="">Size</label>
                                    <select name="size" class="form-control show-tick">
                                        <option value="">-- Size --</option>
                                        <option value="S" {{old('size')=='S'?'selected': ''}}>Small</option>
                                        <option value="M" {{old('size')=='M'?'selected': ''}}>Medium</option>
                                        <option value="L" {{old('size')=='L'?'selected': ''}}>Large</option>
                                        <option value="XL" {{old('size')=='XL'?'selected': ''}}>Extra Large</option>
                                    </select>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <label for="">Condition</label>
                                    <select name="condition" class="form-control show-tick">
                                        <option value="">-- Conditions --</option>
                                        <option value="new" {{old('condition')=='new'?'selected': ''}}>New</option>
                                        <option value="popular" {{old('condition')=='popular'?'selected': ''}}>Popular</option>
                                        <option value="winter" {{old('condition')=='winter'?'selected': ''}}>Winter</option>
                                    </select>
                                </div>

                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <label for="">Sellers</label>
                                    <select name="vendor_id" class="form-control show-tick">
                                        <option value="">-- Sellers --</option>
                                        @foreach(\App\Models\Seller::where('status','active')->get() as $seller)
                                            <option value="{{$seller->id}}" {{old(('vendor_id')==$seller->id? 'selected':'')}}>{{$seller->full_name}}</option>
                                        @endforeach
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
                                {{-- <button type="submit" class="btn btn-outline-secondary">Cancel</button> --}}
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
    $('#lfm,#lfm1').filemanager('image');
</script>
<script>
    $(document).ready(function() {
        $('.description').summernote();
    });
</script>
<script>
    $('#cat_id').change(function(event){
        event.preventDefault();
        // var cat_id=$(this).val();
        var cat_id=$('#cat_id').val();
        {{--// var url = '{{ route("category.child", ":cat_id") }}';--}}
        // url = url.replace(':cat_id', id);
        // alert(cat_id);
        if(cat_id!=null){
            $.ajax({
                // url: window.location.origin + "/admin/category/child/" + cat_id,
                url:"{{route('category.child',$category->id)}}",
                type:"POST",
                data:{
                    "_token":"{{csrf_token()}}",
                    'cat_id': cat_id,
                },
                "success":function(response){
                    var html_option="<option value=''>--child category--</option>";
                    if(response.status){
                        $('#child_cat_div').removeClass('d-none');
                        $.each(response.data,function(title,id){
                            html_option +='<option value="'+id+'">'+title+'</option>'
                        });

                    }
                    else{
                        $('#child_cat_div').addClass('d-none');
                    }
                    $('#child_cat_div').html(html_option);
                }
            });
        }

    });
</script>
@endsection
