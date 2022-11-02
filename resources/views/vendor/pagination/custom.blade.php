<!-- Shop Pagination Area -->

@if($paginator->hasPages())
<div class="shop_pagination_area mt-30">
    <nav aria-label="Page navigation">
        <ul class="pagination pagination-sm justify-content-center">
            @if ($paginator->onFirstPage())
                <li class="disabled page-item" aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <a class="page-link" href="#"> &lsaquo; </a>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link " href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">&lsaquo;</a>
                </li>
            @endif

                {{-- Pagination Elements --}}
                @foreach ($elements as $element)
                    {{-- "Three Dots" Separator --}}
                    @if (is_string($element))
                        <li class="disabled page-item mx-2" aria-disabled="true">
                            <span>{{ $element }}</span>
{{--                            <a class="page-link" href="#">{{ $element }}</a>--}}
                        </li>
                    @endif

                    {{-- Array Of Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <li class="page-item active mr-2" aria-current="page">
{{--                                    <span>{{ $page }}</span>--}}
                                    <a class="page-link " href="#">{{ $page }}</a>
                                </li>
                            @else
                                <li class="page-item mr-2" ><a class="page-link " href="{{ $url }}">{{ $page }}</a></li>
                            @endif
                        @endforeach
                    @endif
                @endforeach

{{--                <li class="page-item active"><a class="page-link" href="#">1</a></li>--}}

                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <li class="page-item">
                        <a class="page-link" href="{{ $paginator->nextPageUrl()}}" rel="next" aria-label="@lang('pagination.next')"> &rsaquo; </a>
                    </li>
                @else
                    <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
{{--                        <span aria-hidden="true">&rsaquo;</span>--}}
                        <a class="page-link" href="#"> &rsaquo; </a>
                    </li>
                @endif
        </ul>
    </nav>
</div>
@endif

