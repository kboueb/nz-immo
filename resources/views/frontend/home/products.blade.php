<section class="product-tabs section-padding position-relative">
    <div class="container">
        @php
            $categories = App\Models\Category::orderBy('cat_name', 'ASC')->get();
            // $catProd = App\Models\Product::where('category_iid',$category_id)->orderBy('id', 'DESC')->get();s
            $products = App\Models\Product::where('product_status',1)->orderBy('id', 'ASC')->limit(10)->get();
        @endphp
        <div class="section-title style-2 wow animate__animated animate__fadeIn">
            <h3> Les annonces </h3>
            <ul class="nav nav-tabs links" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="nav-tab-one" data-bs-toggle="tab" data-bs-target="#tab-one" type="button" role="tab" aria-controls="tab-one" aria-selected="true">Tout</button>
                </li>
                @foreach ($categories as $item)
                    <li class="nav-item" role="presentation">
                        <a  class="nav-link" id="nav-tab-two" data-bs-toggle="tab" href="#category{{ $item->id }}" type="button" role="tab" aria-controls="tab-two" aria-selected="false">{{ $item->cat_name }}</a >
                    </li>
                @endforeach
                
            </ul>
        </div>
        <!--End nav-tabs-->
        
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="tab-one" role="tabpanel" aria-labelledby="tab-one">
                <div class="row product-grid-4">
                        @foreach ($products as $product)
                        <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                            <div class="product-cart-wrap mb-30 wow animate__animated animate__fadeIn" data-wow-delay=".1s">
                                <div class="product-img-action-wrap">
                                    <div class="product-img product-img-zoom">
                                        <a href="{{  url('product/details/'.$product->id.'/'.$product->product_slug) }}">
                                            <img class="default-img" src="{{ asset($product->product_thumbnail) }}" alt="" />
                                            {{--   --}}
                                        </a>
                                    </div>
                                    <div class="product-action-1">
                                        <a aria-label="Add To Wishlist" class="action-btn" href="shop-wishlist.html"><i class="fi-rs-heart"></i></a>
                                        <a aria-label="Quick view" class="action-btn" data-bs-toggle="modal" data-bs-target="#quickViewModal"><i class="fi-rs-eye"></i></a>
                                    </div>
                                </div>
                                <div class="product-content-wrap">
                                    <div class="product-category">
                                        <a href="shop-grid-right.html">{{ $product['category']['cat_name'] }}</a>
                                    </div>
                                    <h2><a href="{{  url('product/details/'.$product->id.'/'.$product->product_slug) }}">{{ $product->product_name }}</a></h2>
                                    
                                    <div>
                                        <span class="font-small text-muted">Propriétaire <a href="vendor-details-1.html">{{ $product['seller']['name'] }}</a></span>
                                    </div>
                                    <div class="product-card-bottom">
                                        <div class="product-price">
                                            <span>{{ $product->product_price }} CFA</span>
                                        </div>
                                        <div class="add-cart">
                                            <a class="add" href="{{  url('product/details/'.$product->id.'/'.$product->product_slug) }}"><i class="fi-rs-phone mr-5"></i>Voir plus</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                <!--End product-grid-4-->
            </div>
            <!--En tab one-->
            @foreach ($categories as $item)
            @php
                $catProd = App\Models\Product::where('category_id',$item->id)->orderBy('id', 'DESC')->get();
            @endphp
            <div class="tab-pane fade" id="category{{ $item->id }}" role="tabpanel" aria-labelledby="tab-two">
                <div class="row product-grid-4">
                    @forelse ($catProd as $product)
                    <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                        <div class="product-cart-wrap mb-30 wow animate__animated animate__fadeIn" data-wow-delay=".1s">
                            <div class="product-img-action-wrap">
                                <div class="product-img product-img-zoom">
                                    <a href="{{  url('product/details/'.$product->id.'/'.$product->product_slug) }}">
                                        <img class="default-img" src="{{ asset($product->product_thumbnail) }}" alt="" />
                                        {{--   --}}
                                    </a>
                                </div>
                                <div class="product-action-1">
                                    <a aria-label="Add To Wishlist" class="action-btn" href="shop-wishlist.html"><i class="fi-rs-heart"></i></a>
                                    <a aria-label="Quick view" class="action-btn" data-bs-toggle="modal" data-bs-target="#quickViewModal"><i class="fi-rs-eye"></i></a>
                                </div>
                            </div>
                            <div class="product-content-wrap">
                                <div class="product-category">
                                    <a href="shop-grid-right.html">{{ $product['category']['cat_name'] }}</a>
                                </div>
                                <h2><a href="{{  url('product/details/'.$product->id.'/'.$product->product_slug) }}">{{ $product->product_name }}</a></h2>
                                
                                <div>
                                    <span class="font-small text-muted">Propriétaire <a href="vendor-details-1.html">{{ $product['seller']['name'] }}</a></span>
                                </div>
                                <div class="product-card-bottom">
                                    <div class="product-price">
                                        <span>{{ $product->product_price }} CFA</span>
                                    </div>
                                    <div class="add-cart">
                                        <a class="add" href="shop-cart.html"><i class="fi-rs-phone mr-5"></i>Contacter</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                        <h5>Oups! Pas d'annonces dans cette catégorie pour le moment</h5>
                    @endforelse
                    <!--end product card-->
                </div>
                <!--End product-grid-4-->
            </div>
            @endforeach
            <!--En tab two-->
        </div>
        <!--End tab-content-->
    </div>
</section>