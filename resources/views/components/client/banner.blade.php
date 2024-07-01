    <div class="Banner">
        <div class="thumb">
            <img class="image-banner" src="{{ asset('assets/client/images/banner/' . $imageBanner) }}" alt="" />
        </div>
        <div class="content">
            {{ $slot }}
        </div>
    </div>
