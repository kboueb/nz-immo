@extends('seller.seller_dashboard')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script> 

@section('seller')
<div class="page-content"> 
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Annonces</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{route('seller.dashboard')}}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Modifier l'annonce</li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->
    <div class="container">
        <div class="main-body">
            <div class="row">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('seller.product.update') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="{{ $product->id }}">
                                <div class="mb-3">
                                    <label for="product_thumbnail" class="form-label">Titre</label>
                                    <input type="text" name="product_name" class="form-control" id="product_name" placeholder="Titre de l'annonce"  value="{{ $product->product_name }}"/>
                                </div>
                                <div class="mb-3">
                                    <label for="product_thumbnail" class="form-label">Description de l'offre</label>
                                    <textarea id="mytextarea" class="form-control" name="product_desc" >{{ $product->product_desc }}</textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="product_thumbnail" class="form-label">Prix</label>
                                    <input type="text" class="form-control" id="product_price" name="product_price" placeholder="50.000 F" value="{{ $product->product_price }}" />
                                </div>
                                <div class="mb-3">
                                    <label for="category_id" class="form-label">Catégorie</label>
                                    <select class="form-select" id="category_id" name="category_id">
                                        @foreach ($cat as $item)
                                            <option value="{{ $item->id }}">{{ $item->cat_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="seller_id" class="form-label">Vendeur</label>
                                    <select class="form-select" id="seller_id" name="seller_id">
                                        {{-- @foreach ($seller as $item) --}}
                                            <option value="{{ $seller }}">{{ $seller }}</option>
                                        {{-- @endforeach --}}
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <input id="special_deal" type="checkbox" class="form-check-input" name="special_deal" value="1"  {{ $product->special_deal == 1 ? 'checked' : ''}}/>
                                    <label for="special_deal" class="form-check-label">Deal de la semaine?</label>
                                </div>
                                <hr>
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary">Enregistrer l'annonce</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('seller.product.thumbnail.update') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="{{ $product->id }}">
                                <input type="hidden" name="old_img" value="{{ $product->product_thumbnail }}">
                                <div class="mb-3">
                                    <label for="product_thumbnail" class="form-label">Image principale</label>
                                    <input id="product_thumbnail" class="form-control" name="product_thumbnail" type="file"/>
                                </div>
                                <div class="mb-3">
                                    <img src="{{ asset($product->product_thumbnail)}}" alt="image product" width="100px" height="100px" />
                                </div>
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary px-4">Enregistrer l'image</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    
                </div>
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Slug</th>
                                            <th>Image</th>
                                            <th>Changer</th>
                                            <th>Supprimer</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <form action="{{ route('seller.product.multiimg.update') }}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $product->id }}">
                                            <input type="hidden" name="old_img" value="{{ $product->product_thumbnail }}">
                                            @if (count($multi_img) > 0)
                                                @foreach ($multi_img as $item)
                                                    <tr>    
                                                        <td>{{ $item->product_slug }}</td>
                                                        <th><img src="{{ asset($item->photo_name)}}" alt="image product" width="40px" height="40px"></th>
                                                        <td><input id="product_thumbnail" class="form-control" name="multiImg[{{ $item->id }}]" type="file"/></td>
                                                        <th><button type="submit" class="btn btn-primary">Mettre à jour</button>
                                                            <button type="submit" class="btn btn-danger">Supprimer</button></th>
                                                    </tr>
                                                @endforeach
                                            @endif
                                        </form>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<script type="text/javascript">
    $(document).ready(function () {
        $('#image').change(function (e) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#showImage').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files[0]);
        });
    });
</script>
@endsection