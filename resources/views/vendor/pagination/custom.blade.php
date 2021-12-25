@if ($paginator->lastPage() > 1)

<div class="flex justify-between flex-1 sm:hidden">
<ul class="pagination">
    <li class="{{ ($paginator->currentPage() == 1) ? ' disabled' : '' }}">
        <a href="{{ $paginator->url(1) }}" style="font-size: 25px; margin-right:10px; color:green; "><-Previous</a>
    </li>
    
    @for ($i = 1; $i <= $paginator->lastPage(); $i++)
        <li class="{{ ($paginator->currentPage() == $i) ? ' active' : '' }}">
            <a href="{{ $paginator->url($i) }}" style="font-size: 25px; margin-right:10px; color:green; text-decoration:underline">{{ $i }}</a>
        </li>
    @endfor
    
    <li class="{{ ($paginator->currentPage() == $paginator->lastPage()) ? ' disabled' : '' }}">
        <a href="{{ $paginator->url($paginator->currentPage()+1) }}"style="font-size: 25px; margin-right:10px; color:green; ">Next-></a>
    </li>
    
    
</ul>
</div>
<div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
    <div>
        <p class="text-sm text-gray-700 leading-5" style="margin-left:30px; padding-top:-30px;">
            {!! __('Showing') !!}
            <span class="font-medium">{{ $paginator->firstItem() }}</span>
            {!! __('to') !!}
            <span class="font-medium">{{ $paginator->lastItem() }}</span>
            {!! __('of') !!}
            <span class="font-medium">{{ $paginator->total() }}</span>
            {!! __('results') !!}
        </p>
    </div>

    
</div>


        
    

    

@endif