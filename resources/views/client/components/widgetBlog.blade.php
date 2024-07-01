<div class="widget-area">
    <div class="widget widget_search">
        <div class="widget_title">
            <span>Search</span>
        </div>
        <div class="widget_content">
            <form action="" method="GET" class="search-form">
                <input class="search-field" type="text" id="search" name="search" placeholder="Search....">
                <button class="search-submit" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
            </form>
        </div>
    </div>
    <div class="widget widget_categories">
        <div class="widget_title">
            <span>Categories</span>
        </div>
        <div class="widget-content">
            <ul>
                @foreach ($blogCategories as $item)
                    <li>
                        <a href="">
                            <div class="cat-name">{{ $item['name'] }}</div>
                            <div class="cat-count">{{ $categoryBlogCounts[$item['id']] ?? 0 }}</div>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
    <div class="widget widget_recent_entries">
        <div class="widget_title">
            <span>Recent Posts</span>
        </div>
        <div class="widget-content">
            <ul>
                @foreach ($recentPosts as $item)
                    <li>
                        <a class="row" href="{{ route('home.blog.detail', ['blog' => $item->id]) }}">
                            <div class="col-lg-4 recent-entry-thumb">
                                <img src="{{ asset('assets/images/' . $item->image_url) }}" alt="">
                            </div>
                            <div class="col-lg-8 recent-entry-info">
                                <span
                                    class="recent-entry-date">{{ \Carbon\Carbon::parse($item['created_at'])->format('F d, Y') }}</span>
                                <h1 class="recent-entry-title">{{ $item->title }}</h1>
                            </div>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
