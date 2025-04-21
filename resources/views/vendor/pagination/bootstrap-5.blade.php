@if ($paginator->hasPages())
<style>
.pagination-nav {
    background-color: #fff;
    padding: 8px 16px;
    border-radius: 40px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    margin-bottom: 20px;
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.pagination {
    margin-bottom: 0;
    gap: 6px;
    display: flex;
    align-items: center;
}

.page-item {
    list-style: none;
}

.page-link {
    display: inline-block;
    border: none;
    border-radius: 50%;
    background-color: transparent;
    color: #333;
    font-weight: 500;
    width: 32px;
    height: 32px;
    font-size: 13px;
    text-align: center;
    line-height: 32px;
    padding: 0;
    transition: background-color 0.3s ease, color 0.3s ease;
}

.page-link:hover {
    background-color: #f0f0f0;
    border-radius: 50%;
}

.page-item.active .page-link {
    background-color: rgb(42, 61, 187);
    color: #fff;
    font-weight: bold;
    border-radius: 50%;
    box-shadow: 0 0 0 3px rgba(92, 106, 196, 0.2);
}

.page-item.disabled .page-link {
    color: #bbb;
    background-color: transparent;
    border-radius: 50%;
    cursor: not-allowed;
    box-shadow: none;
    pointer-events: none;
}
.page-item.ellipsis .page-link {
    border-radius: 8px !important;
    background-color: transparent !important;
    font-weight: bold;
    font-size: 16px;
    width: auto;
    height: auto;
    line-height: normal;
    padding: 0 6px;
    cursor: default;
    box-shadow: none;
}

.small.text-muted {
    margin-right: 1rem;
    margin-bottom: auto;
    color: black;
    font-size: 0.75rem;
}


</style>

    <nav class="pagination-nav d-flex justify-items-center justify-content-between">
        {{-- Mobile View --}}
        <div class="d-flex justify-content-between flex-fill d-sm-none">
            <ul class="pagination">
                {{-- First Page Link --}}
                @if ($paginator->onFirstPage())
                    <li class="page-item disabled" aria-disabled="true">
                        <span class="page-link">First</span>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link" href="{{ $paginator->url(1) }}" rel="first">First</a>
                    </li>
                @endif

                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                    <li class="page-item disabled" aria-disabled="true">
                        <span class="page-link">@lang('pagination.previous')</span>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev">@lang('pagination.previous')</a>
                    </li>
                @endif

                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <li class="page-item">
                        <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next">@lang('pagination.next')</a>
                    </li>
                @else
                    <li class="page-item disabled" aria-disabled="true">
                        <span class="page-link">@lang('pagination.next')</span>
                    </li>
                @endif

                {{-- Last Page Link --}}
                @if ($paginator->hasMorePages())
                    <li class="page-item">
                        <a class="page-link" href="{{ $paginator->url($paginator->lastPage()) }}" rel="last">Last</a>
                    </li>
                @else
                    <li class="page-item disabled" aria-disabled="true">
                        <span class="page-link">Last</span>
                    </li>
                @endif
            </ul>
        </div>

        {{-- Desktop View --}}
        <div class="d-none flex-sm-fill d-sm-flex align-items-sm-center justify-content-sm-between">
            <div>
                <p class="small text-muted">
                    {!! __('Showing') !!}
                    <span class="fw-semibold">{{ $paginator->firstItem() }}</span>
                    {!! __('to') !!}
                    <span class="fw-semibold">{{ $paginator->lastItem() }}</span>
                    {!! __('of') !!}
                    <span class="fw-semibold">{{ $paginator->total() }}</span>
                    {!! __('results') !!}
                </p>
            </div>

            <div>
                <ul class="pagination">
                    {{-- First Page Link --}}
                    @if ($paginator->onFirstPage())
                        <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.first')">
                            <span class="page-link" aria-hidden="true">First</span>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link" href="{{ $paginator->url(1) }}" rel="first" aria-label="@lang('pagination.first')">First</a>
                        </li>
                    @endif

                    {{-- Previous Page Link --}}
                    @if ($paginator->onFirstPage())
                        <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                            <span class="page-link" aria-hidden="true">‹</span>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">‹</a>
                        </li>
                    @endif

                    {{-- Dynamic Page Numbers --}}
                    @php
                        $currentPage = $paginator->currentPage();
                        $totalPages = $paginator->lastPage();
                        $maxVisible = 3;
                        $half = floor($maxVisible / 2);
                        
                        $startPage = max(1, $currentPage - $half);
                        $endPage = min($totalPages, $currentPage + $half);
                        // Adjust when near start
                        if ($currentPage <= $half + 1) {
                            $startPage = 1;
                            $endPage = min($maxVisible, $totalPages);
                        }
                        // Adjust when near end
                        if ($currentPage >= $totalPages - $half) {
                            $endPage = $totalPages;
                            $startPage = max(1, $totalPages - $maxVisible + 1);
                        }
                        $pages = range($startPage, $endPage);
                    @endphp

                    {{-- First Page --}}
                    @if ($startPage > 1)
                        <li class="page-item">
                            <a class="page-link" href="{{ $paginator->url(1) }}">1</a>
                        </li>
                        @if ($startPage > 2)
                        <li class="page-item disabled ellipsis" aria-disabled="true">
                            <span class="page-link">…....</span>
                        </li>

                        @endif
                    @endif

                    {{-- Page Links --}}
                    @foreach ($pages as $page)
                        @if ($page == $currentPage)
                            <li class="page-item active" aria-current="page">
                                <span class="page-link">{{ $page }}</span>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link" href="{{ $paginator->url($page) }}">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach

                    {{-- End Ellipsis and Last Page --}}
                    @if ($endPage < $totalPages)
                        @if ($endPage < $totalPages - 1)
                        <li class="page-item disabled ellipsis" aria-disabled="true">
                            <span class="page-link">…....</span>
                        </li>
                        @endif
                        <li class="page-item">
                            <a class="page-link" href="{{ $paginator->url($totalPages) }}">{{ $totalPages }}</a>
                        </li>
                    @endif

                    {{-- Next Page Link --}}
                    @if ($paginator->hasMorePages())
                        <li class="page-item">
                            <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">›</a>
                        </li>
                    @else
                        <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                            <span class="page-link" aria-hidden="true">›</span>
                        </li>
                    @endif

                    {{-- Last Page Link --}}
                    @if ($paginator->hasMorePages())
                        <li class="page-item">
                            <a class="page-link" href="{{ $paginator->url($paginator->lastPage()) }}" rel="last" aria-label="@lang('pagination.last')">Last</a>
                        </li>
                    @else
                        <li class="page-item disabled" aria-disabled="true">
                            <span class="page-link">Last</span>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
@endif