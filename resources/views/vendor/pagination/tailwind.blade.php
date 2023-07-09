@if ($paginator->hasPages())
    <div class="mt-3 intro-y col-span-12 flex flex-wrap sm:flex-row sm:flex-nowrap items-center">
        <nav class="w-full sm:w-auto sm:mr-auto" role="pagination" aria-label="{{ __('Pagination Navigation') }}">
            <ul class="pagination">
                @if ($paginator->onFirstPage())
                    <li class="page-item" aria-disabled="true">
                        <a class="page-link" href="javascript:;">
                            <i class="w-4 h-4" data-lucide="chevron-left"></i>
                        </a>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link" aria-label="{{ __('pagination.previous') }}" rel="prev"
                            href="{{ $paginator->previousPageUrl() }}">
                            <i class="w-4 h-4" data-lucide="chevron-left"></i>
                        </a>
                    </li>
                @endif

                @foreach ($elements as $element)
                    @if (is_string($element))
                        <li aria-current="page" aria-disabled="true" class="page-item">
                            <a class="page-link" href="javascript:;">...</a>
                        </li>
                    @endif
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <li aria-current="page" aria-disabled="true" class="page-item active">
                                    <a class="page-link" href="javascript:;">{{ $page }}</a>
                                </li>
                            @else
                                <li class="page-item" aria-label="{{ __('Go to page :page', ['page' => $page]) }}">
                                    <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                </li>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                @if ($paginator->hasMorePages())
                    <li class="page-item" aria-label="{{ __('pagination.next') }}" rel="next">
                        <a class="page-link" href="{{ $paginator->nextPageUrl() }}">
                            <i class="w-4 h-4" data-lucide="chevron-right"></i>
                        </a>
                    </li>
                @else
                    <li class="page-item" aria-disabled="true">
                        <a class="page-link" href="javascript:;">
                            <i class="w-4 h-4" data-lucide="chevron-right"></i>
                        </a>
                    </li>
                @endif
            </ul>
        </nav>
    </div>
@endif
