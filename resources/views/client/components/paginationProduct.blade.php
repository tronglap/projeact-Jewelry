<ul class="pagination">
    @if ($currentPage > 1)
        <li class="page-item">
            <a class="page-number"
                href="{{ route('home.shop', ['page' => $currentPage - 1, 'category' => $selectedCategory]) }}">
                <i class="fa-solid fa-angle-left"></i>
            </a>
        </li>
    @endif

    @for ($i = 1; $i <= ceil($totalProducts / $itemPerPage); $i++)
        <li class="page-item {{ $currentPage == $i ? 'active' : '' }}">
            <a class="page-number"
                href="{{ route('home.shop', ['page' => $i, 'category' => $selectedCategory]) }}">{{ $i }}</a>
        </li>
    @endfor

    @if ($currentPage < ceil($totalProducts / $itemPerPage))
        <li class="page-item">
            <a class="page-number"
                href="{{ route('home.shop', ['page' => $currentPage + 1, 'category' => $selectedCategory]) }}">
                <i class="fa-solid fa-angle-right"></i>
            </a>
        </li>
    @endif
</ul>
