@extends('frontend.master_dashboard')

@section('main')

@include('frontend.home.home_slider')
<!--End hero slider-->
@include('frontend.home.category_slider')
<!--End category slider-->
@include('frontend.home.banner')
<!--End banners-->
<!--Products Tabs-->
@include('frontend.home.products')
<!--End Products Tabs-->
<!--Vendor List -->
@include('frontend.home.seller_list')
<!--End Vendor List -->

@endsection