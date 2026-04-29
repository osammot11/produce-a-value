@if ($paginator->hasPages())
    <nav class="admin-pagination-brutal" aria-label="Paginazione">
        @if ($paginator->onFirstPage())
            <span>Indietro</span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}">Indietro</a>
        @endif

        <strong>Pagina {{ $paginator->currentPage() }} di {{ $paginator->lastPage() }}</strong>

        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}">Avanti</a>
        @else
            <span>Avanti</span>
        @endif
    </nav>
@endif
