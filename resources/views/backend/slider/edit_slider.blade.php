@extends('admin.admin_dashboard')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script> 

@section('admin')
<div class="page-content"> 
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Catégories</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Modifier la catégorie</li>
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
                            <form action="{{ route('slider.update') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="{{ $sld->id }}">
                                <input type="hidden" name="old_img" value="{{ $sld->slider_image }}">
                                <div class="mb-3">
                                    <label for="slider_title" class="form-label">Titre</label>
                                    <input type="text" name="slider_title" class="form-control" value="{{$sld->slider_title}}" placeholder="Titre" />
                                </div>

                                <div class="mb-3">
                                    <label for="slider_subtitle" class="form-label">Sous-Titre</label>
                                    <input type="text" name="slider_subtitle" class="form-control" value="{{$sld->slider_subtitle}}" placeholder="Sous-titre" />
                                </div>

                                <div class="mb-3">
                                    <label for="slider_image" class="form-label">Image principale</label>
                                    <input id="slider_image" class="form-control" name="slider_image" type="file" value="{{ $sld->slider_image }}"/>
                                    <div class="mb-3">
                                        <img src="{{ asset($sld->slider_image)}}" alt="image product" width="200px" height="80px" />
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-3"></div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="submit" class="btn btn-primary px-4" value="Enregistrer" />
                                    </div>
                                </div>
                            </form>
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