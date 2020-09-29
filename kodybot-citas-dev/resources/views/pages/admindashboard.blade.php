@extends('layouts.contentLayoutMaster')
{{-- page Title --}}
@section('title','Kdbot - Dashboard')
{{-- vendor css --}}
@section('vendor-styles')
<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/charts/apexcharts.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/extensions/swiper.min.css')}}">
@endsection
@section('page-styles')
<link rel="stylesheet" type="text/css" href="{{asset('css/pages/dashboard-ecommerce.css')}}">
@endsection

@section('content')
<!-- Dashboard Ecommerce Starts -->
<section id="dashboard-ecommerce">
   
    <h1>Dashboard administrador</h1>
    <a class="btn btn-primary" href="{{ route('customers') }}"><i class="bx bxs-group"></i>Clientes</a>
    <a class="btn btn-primary" href="{{ route('calendar') }}"><i class="bx bxs-calendar"></i>Calendario</a>
    <a class="btn btn-primary" href="{{ route('services') }}"><i class="bx bx-briefcase-alt-2"></i>Servicios</a>
</section>
<!-- Dashboard Ecommerce ends -->
@endsection

@section('vendor-scripts')
<script src="{{asset('vendors/js/charts/apexcharts.min.js')}}"></script>
<script src="{{asset('vendors/js/extensions/swiper.min.js')}}"></script>
@endsection

@section('page-scripts')
<script src="{{asset('js/scripts/pages/dashboard-ecommerce.js')}}"></script>
@endsection

