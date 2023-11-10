@extends('frontend.master_dashboard')

@section('main')
<main class="main">
    @php
        $categories = App\Models\Category::orderBy('cat_name', 'ASC')->get();
        // $catProd = App\Models\Product::where('category_iid',$category_id)->orderBy('id', 'DESC')->get();s
        $products = App\Models\Product::where('product_status',1)->orderBy('id', 'ASC')->limit(10)->get();
    @endphp
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="index.html" rel="nofollow"><i class="fi-rs-home mr-5"></i>Accueil</a>
                <span></span> <a href="shop-grid-right.html">Appartement</a> <span></span> {{ $product->product_name }}
            </div>
        </div>
    </div>
    <div class="container mb-30">
        <div class="row">
            <div class="col-xl-10 col-lg-12 m-auto">
                <div class="product-detail accordion-detail">
                    <div class="row mb-50 mt-30">
                        <div class="col-md-6 col-sm-12 col-xs-12 mb-md-0 mb-sm-5">
                            <div class="detail-gallery">
                                <span class="zoom-icon"><i class="fi-rs-search"></i></span>
                                <!-- MAIN SLIDES -->
                                <div class="product-image-slider">
                                    <figure class="border-radius-10">
                                        <img src="{{asset($product->product_thumbnail)}}" alt="product image" />
                                    </figure>
                                </div>
                                <!-- THUMBNAILS -->
                                {{-- <div class="slider-nav-thumbnails">
                                    <div><img src="assets/imgs/shop/thumbnail-3.jpg" alt="product image" /></div>
                                    <div><img src="assets/imgs/shop/thumbnail-4.jpg" alt="product image" /></div>
                                    <div><img src="assets/imgs/shop/thumbnail-5.jpg" alt="product image" /></div>
                                    <div><img src="assets/imgs/shop/thumbnail-6.jpg" alt="product image" /></div>
                                    <div><img src="assets/imgs/shop/thumbnail-7.jpg" alt="product image" /></div>
                                    <div><img src="assets/imgs/shop/thumbnail-8.jpg" alt="product image" /></div>
                                    <div><img src="assets/imgs/shop/thumbnail-9.jpg" alt="product image" /></div>
                                </div> --}}
                            </div>
                            <!-- End Gallery -->
                        </div>
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            <div class="detail-info pr-30 pl-30">
                                <h2 class="title-detail">{{ $product->product_name }}</h2>
                                {{-- <div class="product-detail-rating">
                                    <div class="product-rate-cover text-end">
                                        <div class="product-rate d-inline-block">
                                            <div class="product-rating" style="width: 90%"></div>
                                        </div>
                                        <span class="font-small ml-5 text-muted"> (32 reviews)</span>
                                    </div>
                                </div> --}}
                                <div class="clearfix product-price-cover">
                                    <div class="product-price primary-color float-left">
                                        <span class="current-price text-brand">{{ $product->product_price }} CFA</span>
                                        {{-- <span>
                                            <span class="save-price font-md color3 ml-15">26% Off</span>
                                            <span class="old-price font-md ml-15">$52</span>
                                        </span> --}}
                                    </div>
                                </div>
                                <div class="short-desc mb-30">
                                    <p class="font-lg">{{ $product->product_desc }}</p>
                                </div>
                                {{-- <div class="attr-detail attr-size mb-30">
                                    <strong class="mr-10">Size / Weight: </strong>
                                    <ul class="list-filter size-filter font-small">
                                        <li><a href="#">50g</a></li>
                                        <li class="active"><a href="#">60g</a></li>
                                        <li><a href="#">80g</a></li>
                                        <li><a href="#">100g</a></li>
                                        <li><a href="#">150g</a></li>
                                    </ul>
                                </div> --}}
                                <div class="detail-extralink mb-50">
                                    <div class="add-cart">
                                        <a class="add btn" href="{{ route('add.reservation', $product->id) }}"><i class="fi-rs-phone mr-5"></i>Réserver</a>
                                    </div>
                                    <a class="btn add" href="{{ route('add.demande', $product->id) }}"><i class="fi-rs-phone mr-5"></i>Demander une location</a>
                                </div>
<div class="font-xs">
<ul class="mr-50 float-start">
    <li class="mb-5">Nombre de pièces: <span class="text-brand">{{ $product->nbre_pieces }}</span></li>
    <li class="mb-5">Catégorie:<span class="text-brand"> {{ $product['category']['cat_name'] }}</span></li>
    <li>Propriétaire: <span class="text-brand">{{ $product['seller']['name'] }}</span></li>
</ul>

</div>
                            </div>
                            <!-- Detail Info -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</main>
@endsection