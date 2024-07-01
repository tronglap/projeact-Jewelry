<div>
    <div class="Card_news">
        <a href="{{ route('home.blog.detail', $blogId) }}">
            <div class="thumb">
                <img src={{ asset('assets/images/' . $image) }} alt="{{ $title }}" />
            </div>
        </a>
        <div class="infor">
            <div class="date">
                <p>
                    {{ \Carbon\Carbon::parse($date)->format('F d, Y') }}<span> - </span>By Admin
                </p>
            </div>
            <div class="title">
                <a href="{{ route('home.blog.detail', $blogId) }}">
                    <h4>{{ $title }}</h4>
                </a>
            </div>
            <div class="content">
                <p class="description">
                    {!! $description !!}
                </p>
            </div>
            <a href="{{ route('home.blog.detail', $blogId) }}">
                <p class="view">View More</p>
            </a>
        </div>
    </div>
</div>
