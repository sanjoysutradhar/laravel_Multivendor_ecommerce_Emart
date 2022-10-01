<script src="{{asset('backend/assets/bundles/libscripts.bundle.js')}}"></script>    
<script src="{{asset('backend/assets/bundles/vendorscripts.bundle.js')}}"></script>

<script src="{{asset('backend/assets/bundles/jvectormap.bundle.js')}}"></script> <!-- JVectorMap Plugin Js -->
<script src="{{asset('backend/assets/bundles/morrisscripts.bundle.js')}}"></script>
<script src="{{asset('backend/assets/bundles/knob.bundle.js')}}"></script>
{{-- switch button --}}
<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap-switch-button@1.1.0/dist/bootstrap-switch-button.min.js"></script>
{{-- summernote --}}
<script src="{{asset('backend/assets/summernote/summernote-bs4.min.js')}}"></script>


<script src="{{asset('backend/assets/bundles/mainscripts.bundle.js')}}"></script>
<script src="{{asset('backend/assets/js/pages/ui/sortable-nestable.js')}}"></script>
<!-- Jquery DataTable Plugin Js --> 
<script src="{{asset('backend/assets/bundles/datatablescripts.bundle.js')}}"></script>
<script src="{{asset('backend/assets/js/pages/tables/jquery-datatable.js')}}"></script>
<script src="{{asset('backend/assets/js/index.js')}}"></script>

@yield('scripts')

<script>
    setTimeout(function(){
        $('#alert').slideUp()
    }, 4000);
</script>