<div class="Card_item">
    <div class="thumb">
        <a href="{{ route('home.shop.detail', $productid) }}">
            <img src="{{ asset('assets/images/' . $imageurl) }}" alt="">
            <img src="{{ asset('assets/images_second/' . $imageurlsecond) }}" alt="">
        </a>
    </div>
    @if ($sale == 1)
        <div class="sale active">SALE {{ $salepercent }}%</div>
    @endif
    <div class="info">
        <div class="cate">{{ $category }}</div>
        <a class="name">
            {{ $name }}
        </a>
        <div class="material">diamond</div>
        <div class="price">
            @if ($price <= 0 || $quantity <= 10)
                <span class="soldOut">
                    <span style="display:none">{{ $quantity }}</span>
                </span>
            @else
                @if (is_null($promotion) || $promotion == '0')
                    <span class="cost">
                        ${{ $price }}
                    </span>
                @else
                    <span class="discount active">
                        ${{ $promotion }}
                    </span>
                    <span class="cost active">
                        ${{ $price }}
                    </span>
                @endif
            @endif
        </div>
    </div>
</div>
