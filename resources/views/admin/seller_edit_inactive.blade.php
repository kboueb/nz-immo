@extends('admin.admin_dashboard')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script> 

@section('admin')
        <div class="page-content"> 
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Profil utilisateur</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Admin Profile</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!--end breadcrumb-->
            <div class="container">
                <div class="main-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <form action="{{ route('seller.status.active') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $seller->id }}">
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Username</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <input type="text" class="form-control" value="{{$seller->username}}" disabled/>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Nom de la boutique</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <input type="text" name="name" class="form-control" value="{{$seller->name}}" />
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Email</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <input type="email" name="email" class="form-control" value="{{$seller->email}}" />
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Téléphone</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <input type="text" name="phone" class="form-control" value="{{$seller->phone}}" />
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Adresse</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <input type="text" name="address" class="form-control" value="{{$seller->address}}" />
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Infos</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <textarea type="text" name="seller_join" class="form-control" value="{{$seller->seller_short_info}}" ></textarea> 
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Membre depuis</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <input type="text" name="seller_join" class="form-control" value="{{$seller->seller_join}}" />
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Photo</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <input type="file" name="photo" class="form-control" id="image"/>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0"></h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <img id="showImage" src="{{ (!empty($seller->photo)) ? url('upload/seller_images/'.$seller->photo) : url('upload/no_image.jpg') }}" alt="Admin" style="width:100px;height:100px">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-3"></div>
                                            <div class="col-sm-9 text-secondary">
                                                <input type="submit" class="btn btn-success px-4" value="Activer le compte" />
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