@extends('admin.admin_dashboard')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script> 

@section('admin')
<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Sldégories</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Toutes les sldégories</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{ route('add.slider') }}" type="button" class="btn btn-primary">Ajouter un slide</a>
            </div>
        </div>
    </div>
    <!--end breadcrumb-->
    <h6 class="mb-0 text-uppercase">Liste des slides</h6>
    <hr/>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Titre</th>
                            <th>Sous-Titre</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($sld) > 0)
                            @foreach ($sld as $item)
                                <tr>    
                                    <td><img src="{{ asset($item->slider_image)}}" alt="image product" width="120px" height="40px"></td>
                                    <td>{{ $item->slider_title }}</td>
                                    <td>{{ $item->slider_subtitle }}</td>
                                    <td>
                                        <a href="{{ route('slider.edit', $item->id)}}" class="btn btn-warning">Modifier</a>
                                        <a href="{{ route('slider.delete', $item->id)}}" class="btn btn-danger" id="delete-slide">Supprimer</a>
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