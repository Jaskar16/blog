@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="my-2 flex justify-center">
        <div class="join">

            @if ($paginator->onFirstPage())
                <button class="join-item btn btn-outline btn-disabled" disabled aria-disabled="true">
                    {!! __('pagination.previous') !!}
                </button>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="join-item btn btn-outline">
                    {!! __('pagination.previous') !!}
                </a>
            @endif

            <button class="join-item btn btn-outline pointer-events-none" aria-current="page">
                {{ __('Page') }} {{ $paginator->currentPage() }}
            </button>

            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="join-item btn btn-outline">
                    {!! __('pagination.next') !!}
                </a>
            @else
                <button class="join-item btn btn-outline btn-disabled" disabled aria-disabled="true">
                    {!! __('pagination.next') !!}
                </button>
            @endif

        </div>
    </nav>
@endif
