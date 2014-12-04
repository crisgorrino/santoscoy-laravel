@if ($paginator->getLastPage() > 1)
<?php $previousPage = ($paginator->getCurrentPage() > 1) ? $paginator->getCurrentPage() - 1 : 1; ?>  
    <ul class="pagination">
    	@if( $paginator->getCurrentPage() <= 1 )
        	<li class="disabled"><span>|&lsaquo;</span></li>
        	<li class="disabled"><span>&laquo;</span></li>
        @else
            <li><a href="{{ $paginator->getUrl(1) }}">|&lsaquo;</a></li>
            <li><a href="{{ $paginator->getUrl($previousPage) }}" class="previous item"><i class="icon left arrow"></i> &laquo; </a></li>
        @endif
        @foreach ($paginator->getPagesRange() as $page)
            @if( $paginator->getCurrentPage() == $page )
                <li class="active"><span>{{ $page }}</span></li>
            @else
                <li><a href="{{ $paginator->getUrl($page) }}">{{ $page }}</a></li>
            @endif
        @endforeach
        @if( $paginator->getCurrentPage() >= $paginator->getLastPage() )
        	<li class="disabled"><span>&raquo;</span></li>
            <li class="disabled"><span>&rsaquo;|</span></li>
        @else
        	<li><a href="{{ $paginator->getUrl($paginator->getCurrentPage()+1) }}" class="next item"> &raquo; <i class="icon right arrow"></i></a></li>
            <li><a href="{{ $paginator->getUrl($paginator->getLastPage()) }}">&rsaquo;|</a></li>
        @endif
    </ul>
@endif