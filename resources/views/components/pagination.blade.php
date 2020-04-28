@if ($paginator->hasPages())
    <ul class="pagination pg-blue">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                <a class="page-link" href="" title="Previous page">
                    <span aria-hidden="true">&laquo;</span>
                    <span class="sr-only">@lang('pagination.previous')</span>
                </a>
            </li>
        @else
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')" title="Previous page">
                    <span aria-hidden="true">&laquo;</span>
                    <span class="sr-only">@lang('pagination.previous')</span>
                </a>
            </li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ( $elements as $element )
            {{-- "Three Dots" Separator --}}
            @if ( is_string($element) )
                <li class="page-item disabled" aria-disabled="true"><a class="page-link">{{ $element }}</a></li>
            @endif

            {{-- Array Of Links --}}
            @if ( is_array($element) )
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="page-item active" aria-current="page">
                            <a class="page-link" href="#!">{{ $page }}</a>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                        </li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')" title="Next page">
                    <span aria-hidden="true">&raquo;</span>
                    <span class="sr-only">@lang('pagination.next')</span>
                </a>
            </li>
        @else
            <li class="page-item disabled" aria-disabled="true">
                <a class="page-link" href="" aria-label="@lang('pagination.next')" title="Next page">
                    <span aria-hidden="true">&raquo;</span>
                    <span class="sr-only">@lang('pagination.next')</span>
                </a>
            </li>
        @endif
    </ul>
@endif
