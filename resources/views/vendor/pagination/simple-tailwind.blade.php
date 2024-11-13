{{-- @if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="flex justify-between">

        @if ($paginator->onFirstPage())
            <span
                class="items-center px-4 py-2 text-sm font-medium text-black bg-light border-gray-300 cursor-default leading-5 rounded-md">
                {!! __('pagination.previous') !!}
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev"
                class="items-center px-4 py-2 text-sm font-medium text-white bg-primary border border-gray-300 leading-5 rounded-md hover:text-gray-500 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150">
                {!! __('pagination.previous') !!}
            </a>
        @endif

        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" rel="next"
                class="items-center px-4 py-2 text-sm font-medium text-white bg-primary border border-gray-300 leading-5 rounded-md hover:text-gray-500 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150">
                {!! __('pagination.next') !!}
            </a>
        @else
            <span
                class="items-center px-4 py-2 text-sm font-medium text-black bg-light border border-gray-300 cursor-default leading-5 rounded-md">
                {!! __('pagination.next') !!}
            </span>
        @endif
    </nav>
@endif --}}
@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="flex justify-between">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span
                class="items-center px-3 py-2 text-sm font-medium text-black bg-light border border-gray-500 cursor-default leading-5" style="">
                Sebelumnya
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev"
                class="items-center px-3 py-2 text-sm font-medium text-black bg-primary-subtle border border-gray-500 leading-5 hover:text-gray-500 focus:outline-none focus:ring ring-gray-500 focus:border-blue-500 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150" style="text-decoration: none;">
                Sebelumnya
            </a>
        @endif

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" rel="next"
                class="items-center px-3 py-2 text-sm font-medium text-black bg-primary-subtle border border-gray-500 leading-5 hover:text-gray-500 focus:outline-none focus:ring ring-gray-500 focus:border-blue-500 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150" style=" text-decoration: none;">
                Selanjutnya
            </a>
        @else
            <span
                class="items-center px-3 py-2 text-sm font-medium text-black bg-light border border-gray-500 cursor-default leading-5" style="">
                Selanjutnya
            </span>
        @endif
    </nav>
@endif

