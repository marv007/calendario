@extends('layouts.contentLayoutMaster')
{{-- page Title --}}
@section('title','Kdbot - Dashboard')
{{-- vendor css --}}
@section('vendor-styles')
<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/charts/apexcharts.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/extensions/swiper.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/pickers/pickadate/pickadate.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/pickers/daterange/daterangepicker.css')}}">

@endsection
@section('page-styles')
<link rel="stylesheet" type="text/css" href="{{asset('css/pages/dashboard-ecommerce.css')}}">
@endsection

@section('content')
<!-- Dashboard Ecommerce Starts -->
<section id="service">
   
    <h3>Servicio:</h3>
     <!-- // Basic multiple Column Form section start -->
     <section id="multiple-column-form">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Datos</h4>
                    </div>                    
                    @if(isset($success))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>¡Exitoso!</strong> Se han guardado los cambios con éxito.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      @endif
                    <div class="card-content">
                        <div class="card-body">
                        <form class="form" method="POST" action="{{route('updateservice')}}">
                            @csrf
                                <div class="form-body">
                                    <div class="row">                                    
                                    <input type="hidden" name="idservice" value="{{$service->id_service}}">
                                        <div class="col-md-6 col-12">
                                            <div class="form-label-group">
                                            <input type="text" id="name-column" class="form-control" placeholder="Nombre" name="name" value="{{$service->service_name}}" @if (!$edit): readonly : '' @endif>
                                                <label for="name-column">Nombre</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-label-group">
                                                <input type="textarea" id="description" class="form-control" placeholder="Descripción" name="description" value="{{$service->service_description}}" @if (!$edit): readonly : '' @endif>
                                                <label for="description">Descripción</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-label-group">
                                                <input type="number" step="any" id="price" class="form-control" placeholder="Precio" name="price" min="0" value="{{$service->service_price}}" @if (!$edit): readonly : '' @endif>
                                                <label for="price">Precio</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-label-group">
                                                @if($edit || $add)
                                                <label for="category">Categoría</label>
                                                <select id="category" class="form-control" name="category" value="{{$service->category_idcategory}}">
                                                    @foreach ($categories as $category)
                                                    <option value="{{$category->idcategory}}">{{$category->category_name}} </option>
                                                    @endforeach
                                                </select>
                                                @else
                                                <input type="text" id="category" class="form-control" name="category" placeholder="Categoría" value="{{$service->category->category_name}}" @if (!$edit): readonly : '' @endif>
                                                @endif
                                                
                                                <label for="category">Categoría</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-label-group">                            
                                               <input type="text"  id="duration" name="duration" class="form-control"   placeholder="Duración" value="{{$service->service_duration_time}}" @if (!$edit): disabled : '' @endif>
                                               <label for="duration">Duración</label>
                                            </div>
                                                                                       
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-label-group">
                                                <input type="text" id="concurrent" class="form-control" name="concurrent" placeholder="Subservicio" value="{{$service->concurrent_services}}" @if (!$edit): readonly : '' @endif>
                                                <label for="concurrent">Subservicio de</label>
                                            </div>
                                        </div>
                                        
                                        
                                        <div class="col-12 d-flex justify-content-end">
                                            @if (!$edit)
                                            <a href="{{route('editservice', [$service->id_service])}}" class="btn btn-primary mr-1 mb-1">Editar</a> 
                                            @endif                                            
                                            <button type="submit" class="btn btn-primary mr-1 mb-1" @if (!$edit): disabled : '' @endif>Guardar</button>
                                            <button type="reset" class="btn btn-light-secondary mr-1 mb-1" @if (!$edit): disabled : '' @endif>Reset</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <a class="btn btn-primary" href="{{ url()->previous() }}"><i class="bx bx-arrow-back"></i>Atrás</a>
    </section> 
     
    

</section>
<!-- Dashboard Ecommerce ends -->
@endsection

@section('vendor-scripts')
<script src="{{asset('vendors/js/charts/apexcharts.min.js')}}"></script>
<script src="{{asset('vendors/js/extensions/swiper.min.js')}}"></script>
<script src="{{asset('vendors/js/tables/datatable/datatables.min.js')}}"></script>
<script src="{{asset('vendors/js/tables/datatable/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('vendors/js/tables/datatable/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('vendors/js/tables/datatable/buttons.html5.min.js')}}"></script>
<script src="{{asset('vendors/js/tables/datatable/buttons.print.min.js')}}"></script>
<script src="{{asset('vendors/js/tables/datatable/buttons.bootstrap.min.js')}}"></script>
<script src="{{asset('vendors/js/tables/datatable/pdfmake.min.js')}}"></script>
<script src="{{asset('vendors/js/tables/datatable/vfs_fonts.js')}}"></script>
<script src="{{asset('vendors/js/pickers/pickadate/picker.js')}}"></script>
<script src="{{asset('vendors/js/pickers/pickadate/picker.date.js')}}"></script>
<script src="{{asset('vendors/js/pickers/pickadate/picker.time.js')}}"></script>
<script src="{{asset('vendors/js/pickers/pickadate/legacy.js')}}"></script>
<script src="{{asset('vendors/js/pickers/daterange/moment.min.js')}}"></script>
<script src="{{asset('vendors/js/pickers/daterange/daterangepicker.js')}}"></script>
@endsection

@section('page-scripts')
<script src="{{asset('js/scripts/pickers/dateTime/pick-a-datetime.js')}}"></script>
@endsection

