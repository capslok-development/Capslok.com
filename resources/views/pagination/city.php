@if ($politicians_info->hasPages())
    <ul class="pagination">
        {{-- Previous Page Link --}}
        <a style="color:white; padding-left:5px;" href="{{ $politicians_info->appends(['politicians_info' => $politicians_info->currentPage()])->links() }}" rel="prev">
            <div style="border:1px solid black; width:20px; height:20px; background-color:grey;">
                @if ($politicians_info->onFirstPage())
                    <span style="color:white">&laquo;</span>
                @else
                        &laquo;
                @endif
            </div>
        </a>

        {{-- Pagination Elements --}}
        {{--@foreach ($politicians_info as $element)
             "Three Dots" Separator
            @if (is_string($element))
                <li class="disabled"><span>{{ $element }}</span></li>
            @endif

             Array Of Links
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $politicians_info->currentPage())
                        <li class="active"><span>{{ $page }}</span></li>
                    @else
                        <li><a href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach--}}

        {{-- Next Page Link --}}
        {{--<a style="color:white; padding-left:5px;" href="{{ $politicians_info->nextPageUrl() }}" rel="next">--}}
        <a style="color:white; padding-left:5px;" href="{{ $politicians_info->appends(['politicians_info' => $politicians_info->currentPage()])->links() }}" rel="next">
            <div style="border:1px solid black; width:20px; height:20px; background-color:grey;">
                @if ($politicians_info->hasMorePages())
                    &raquo;
                @else
                    <span style="color:white">&raquo;</span>
                @endif
            </div>
        </a>
    </ul>
@endif