@extends('admin.admin_dashboard')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script> 

@section('admin')
<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Biens Immobiliers</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Toutes les biens</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{ route('add.product') }}" type="button" class="btn btn-primary">Ajouter un bien</a>
            </div>
        </div>
    </div>
    <!--end breadcrumb-->
    <h6 class="mb-0 text-uppercase">Liste des biens : <span class="badge rounded-pill bg-primary">{{ count($product) }}</span></h6>
    <hr/>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Image</th>
                            <th>Nom</th>
                            <th>Prix</th>
                            <th>categorie</th>
                            <th>Nbre pièces</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($product) > 0)
                            @foreach ($product as $item)
                                @php
                                    $categories = App\Models\Category::orderBy('cat_name', 'ASC')->get();
                                    $catProd = App\Models\Product::where('category_id',$item->id)->orderBy('id', 'DESC')->get();
                                @endphp
                                <tr>    
                                    <td>{{ $item->id }}</td>
                                    <th><img src="{{ asset($item->product_thumbnail)}}" alt="image product" width="70px" height="70px"></th>
                                    <td>{{ $item->product_name }}</td>
                                    <th>{{$item->product_price}} FCFA</th>
                                    <th>
                                            @foreach ($cat as $cate)
                                            @if ($item->category_id == $cate->id)
                                                {{ $cate->cat_name }}
                                            @endif
                                            @endforeach
                                        </th>
                                    <th>{{$item->nbre_pieces}}</th>
                                    <th>
                                        @if ($item->product_status == 1)
                                            <span class="badge rounded-pill bg-success">Actif</span>
                                        @else
                                            <span class="badge rounded-pill bg-danger">Inactif</span>
                                        @endif
                                    </th>
                                    
                                    <td>
                                        <a href="{{ route('product.edit', $item->id)}}" class="btn btn-warning text-white" title="Modifier"><i class="py-3 bx bx-pencil"></i></a>
                                        {{-- <a href="{{ route('product.show', $item->id)}}" class="btn btn-primary text-white" title="Voir la fiche"><i class="py-3 bx bx-file"></i></a> --}}
                                        <a href="{{ route('product.delete', $item->id)}}" class="btn btn-danger" id="delete" title="Supprimer"><i class="py-3 bx bx-trash"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection