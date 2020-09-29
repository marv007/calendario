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
<section id="customers">
   
    <h3>Cliente:</h3>
     <!-- // Basic multiple Column Form section start -->
     <section id="multiple-column-form">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Datos</h4>
                    </div>                    
                    
                    <div class="col-md-12 col-12 alert alert-success alert-dismissible fade show" role="alert">
                        <strong>¡Exitoso!</strong> Se han guardado los cambios con éxito.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      
                    <div class="card-content">
                        <div class="card-body">
                        <form class="form" method="POST" action="{{route('updatecustomer')}}">
                            @csrf
                                <div class="form-body">
                                    <div class="row">                                    
                                    <input type="hidden" name="idcustomer" value="{{$customer->idcustomer}}">
                                        <div class="col-md-6 col-12">
                                            <div class="form-label-group">
                                            <input type="text" id="first-name-column" class="form-control" placeholder="Nombre" name="fname" value="{{$customer->customer_name}}" @if (!$edit): readonly : '' @endif>
                                                <label for="first-name-column">Nombre</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-label-group">
                                                <input type="text" id="last-name" class="form-control" placeholder="Apellido" name="lname" value="{{$customer->customer_last_name}}" @if (!$edit): readonly : '' @endif>
                                                <label for="last-name">Apellido</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-label-group">
                                                <input type="text" id="phone" class="form-control" placeholder="Teléfono" name="phone" value="{{$customer->customer_phone}}" @if (!$edit): readonly : '' @endif>
                                                <label for="phone">Teléfono</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-label-group">
                                                <input type="email" id="email" class="form-control" name="email" placeholder="Email" value="{{$customer->customer_email}}" @if (!$edit): readonly : '' @endif>
                                                <label for="email">Email</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-label-group">                            
                                               <input type="text"  id="birthday" class="form-control pickadate-months-year" placeholder="Cumpleaños" value="{{$customer->customer_birthday}}" @if (!$edit): disabled : '' @endif>
                                               <label for="birthday">Cumpleaños</label>
                                            </div>
                                                                                       
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-label-group">
                                                <input type="text" id="gender" class="form-control" name="gender" placeholder="Sexo" value="{{$customer->gender}}" @if (!$edit): readonly : '' @endif>
                                                <label for="gender">Sexo</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-label-group">
                                                <input type="text" id="dni" class="form-control" name="dni" placeholder="Documento de identidad" value="{{$customer->dni}}" @if (!$edit): readonly : '' @endif>
                                                <label for="dni">Documento de identidad</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-label-group">
                                                <input type="text" id="tax_id" class="form-control" name="tax_id" placeholder="Número de identificación de contribuyente" value="{{$customer->tax_id}}" @if (!$edit): readonly : '' @endif>
                                                <label for="tax_id">Número de identificación de contribuyente</label>
                                            </div>
                                        </div>                                        
                                        <div class="col-md-6 col-12">
                                            <div class="form-label-group">
                                                @if($edit)
                                                <select id="company" class="form-control" name="company" value="{{$company->idcompany}}">
                                                    @foreach ($companies as $compan)
                                                    <option value="{{$compan->idcompany}}">{{$compan->company_name}} </option>
                                                    @endforeach
                                                </select>
                                                @else
                                                <input type="text" id="company" class="form-control" name="company" placeholder="Empresa" value="{{$company->company_name}}" @if (!$edit): readonly : '' @endif>
                                                @endif
                                                <label for="company">Empresa</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-label-group">
                                                <input type="text" id="fb_user_id" class="form-control" name="fb_user_id" placeholder="Usuario de Facebook" value="{{$customer->fb_user_id}}" @if (!$edit): readonly : '' @endif>
                                                <label for="fb_user_id">Usuario de Facebook</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <label for="status">Estado</label>
                                            <ul class="list-unstyled mb-0" id="status">
                                                <li class="d-inline-block mr-2 mb-1">
                                                    <fieldset>
                                                        <div class="radio">
                                                            <input type="radio" name="bsradio" id="radio1" @if ($customer->customer_status=='active'): checked : '' @endif @if (!$edit): disabled : '' @endif>
                                                            <label for="radio1">Activo</label>
                                                        </div>
                                                    </fieldset>
                                                </li>
                                                <li class="d-inline-block mr-2 mb-1">
                                                    <fieldset>
                                                        <div class="radio">
                                                            <input type="radio" name="bsradio" id="radio2" @if ($customer->customer_status=='inactive'): checked : '' @endif @if (!$edit): disabled : '' @endif>
                                                            <label for="radio2">Inactivo</label>
                                                        </div>
                                                    </fieldset>
                                                </li>                                                
                                            </ul>
                                        </div>
                                        
                                        <div class="col-12 d-flex justify-content-end">
                                            @if (!$edit)
                                            <a href="{{route('editcustomer', [$customer->idcustomer])}}" class="btn btn-primary mr-1 mb-1">Editar</a> 
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

