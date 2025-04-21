@if ($paginator->hasPages())
    <ul class="pagination">
        <!-- First Page Link -->
        @if ($paginator->onFirstPage())
            <li class="page-item disabled"><span class="page-link">First</span></li>
        @else
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->url(1) }}" rel="first">First</a>
            </li>
        @endif

        <!-- Previous Page Link -->
        @if ($paginator->onFirstPage())
            <li class="page-item disabled"><span class="page-link">&laquo;</span></li>
        @else
            <li class="page-item"><a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev">&laquo;</a></li>
        @endif

        <!-- Pagination Elements (Page Numbers) -->
        @foreach ($elements as $element)
            <!-- "Three Dots" Separator -->
            @if (is_string($element))
                <li class="page-item disabled"><span class="page-link">{{ $element }}</span></li>
            @endif

            <!-- Array of Links -->
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="page-item active" aria-current="page"><span class="page-link">{{ $page }}</span></li>
                    @else
                        <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach

        <!-- Next Page Link -->
        @if ($paginator->hasMorePages())
            <li class="page-item"><a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next">&raquo;</a></li>
        @else
            <li class="page-item disabled"><span class="page-link">&raquo;</span></li>
        @endif

        <!-- Last Page Link -->
        @if ($paginator->hasMorePages())
            <li class="page-item"><a class="page-link" href="{{ $paginator->url($paginator->lastPage()) }}" rel="last">Last</a></li>
        @else
            <li class="page-item disabled"><span class="page-link">Last</span></li>
        @endif
    </ul>
@endif
