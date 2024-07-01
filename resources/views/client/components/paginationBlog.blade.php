<!-- Hiển thị phân trang -->
<ul class="pagination">
    <!-- Nút Previous -->
    @if ($currentPage > 1)
        <li class="page-item">
            <a class="page-number" href="{{ route('home.blog.index', ['page' => $currentPage - 1]) }}">
                <i class="fa-solid fa-angle-left"></i>
            </a>
        </li>
    @else
        <li class="page-item disabled">
            <span class="page-number"><i class="fa-solid fa-angle-left"></i></span>
        </li>
    @endif

    <!-- Các trang số -->
    @for ($i = 1; $i <= ceil($totalBlogs / $itemPerPage); $i++)
        <li class="page-item {{ $currentPage == $i ? 'active' : '' }}">
            <a class="page-number" href="{{ route('home.blog.index', ['page' => $i]) }}">{{ $i }}</a>
        </li>
    @endfor

    <!-- Nút Next -->
    @if ($currentPage < ceil($totalBlogs / $itemPerPage))
        <li class="page-item">
            <a class="page-number" href="{{ route('home.blog.index', ['page' => $currentPage + 1]) }}">
                <i class="fa-solid fa-angle-right"></i>
            </a>
        </li>
    @else
        <li class="page-item disabled">
            <span class="page-number"><i class="fa-solid fa-angle-right"></i></span>
        </li>
    @endif
</ul>
