        <div class="banner">
            <div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active slide-1" data-bs-interval="2500">
                        <img src="{{ asset('assets/client/images/banner/slider_1.png') }}" alt="...">
                        <div class="carousel-caption d-none d-md-block">
                            <h3>Finest Jewelry</h3>
                            <p>Jewelry that sparkles as brilliantly as your inner light</p>
                            <a href="{{ route('home.shop') }}">
                                <x-client.button title="SHOP NOW"></x-client.button>
                            </a>
                        </div>
                    </div>
                    <div class="carousel-item" data-bs-interval="2500">
                        <img src="{{ asset('assets/client/images/banner/slider_2.jpg') }}" alt="" />
                        <div class="carousel-caption d-none d-md-block">
                            <h3>Radiant Elegance</h3>
                            <p>Shine bright with exquisite jewelry that tells your unique story</p>
                            <a href="{{ route('home.shop') }}">
                                <x-client.button title="SHOP NOW"></x-client.button>
                            </a>
                        </div>
                    </div>
                    <div class="carousel-item" data-bs-interval="2500">
                        <img src="{{ asset('assets/client/images/banner/slider_3.jpg') }}" alt="" />
                        <div class="carousel-caption d-none d-md-block">
                            <h3>Timeless Craft</h3>
                            <p>Unveil elegance with our handcrafted jewelry, perfect for every occasion</p>
                            <a href="{{ route('home.shop') }}">
                                <x-client.button title="SHOP NOW"></x-client.button>
                            </a>
                        </div>
                    </div>
                    <div class="carousel-item" data-bs-interval="2500">
                        <img src="{{ asset('assets/client/images/banner/slider_4.jpg') }}" alt="" />
                        <div class="carousel-caption d-none d-md-block">
                            <h3>Sublime Artistry</h3>
                            <p>Elegance and beauty intertwined in every piece we create</p>
                            <a href="{{ route('home.shop') }}">
                                <x-client.button title="SHOP NOW"></x-client.button>
                            </a>
                        </div>
                    </div>
                    <div class="carousel-item" data-bs-interval="2500">
                        <img src="{{ asset('assets/client/images/banner/slider_5.jpg') }}" alt="" />
                        <div class="carousel-caption d-none d-md-block">
                            <h3 style="color: white">Captivating Allure</h3>
                            <p style="color: white">Discover the allure of our meticulously crafted, stunning jewelry
                            </p>
                            <a href="{{ route('home.shop') }}">
                                <x-client.button-two title="SHOP NOW"></x-client.button-two>
                            </a>
                        </div>
                    </div>
                    <div class="carousel-item" data-bs-interval="2500">
                        <img src="{{ asset('assets/client/images/banner/slider_6.jpg') }}" alt="" />
                        <div class="carousel-caption d-none d-md-block">
                            <h3 style="color: white">Luxury Adorned</h3>
                            <p style="color: white">Adorn yourself with luxury, beauty, and timeless jewelry pieces</p>
                            <a href="{{ route('home.shop') }}">
                                <x-client.button-two title="SHOP NOW"></x-client.button-two>
                            </a>
                        </div>
                    </div>
                    <div class="carousel-item" data-bs-interval="2500">
                        <img src="{{ asset('assets/client/images/banner/slider_7.jpg') }}" alt="" />
                        <div class="carousel-caption d-none d-md-block">
                            <h3 style="color: white">Classic Modernity</h3>
                            <p style="color: white">Let your jewelry shine as bright as your smile</p>
                            <a href="{{ route('home.shop') }}">
                                <x-client.button-two title="SHOP NOW"></x-client.button-two>
                            </a>
                        </div>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
