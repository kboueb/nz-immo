<section class="banners mb-25">
    <div class="container">
        @php
            $categories = App\Models\Category::orderBy('cat_name', 'ASC')->get();
        @endphp
        <div class="row">
            @foreach ($categories as $cat)
                <div class="col-lg-4 col-md-6">
                    <div class="banner-img wow animate__animated animate__fadeInUp" data-wow-delay="0">
                        <img src="{{ asset('frontend/assets/imgs/banner/banner.svg') }}" alt="" />
                        <div class="banner-text">
                            <h4 class="">{{ $cat->cat_name }}</h4>
                            @php
                                $products = App\Models\Product::where('category_id', $cat->id)->get();
                            @endphp
                            <a href="shop-grid-right.html" class="btn btn-xs">{{count($products)}} annonce(s) <i class="fi-rs-arrow-small-right"></i></a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>