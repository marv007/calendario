@extends('layouts.contentLayoutMaster')
{{-- page Title --}}
@section('title','Kdbot - Dashboard')
{{-- vendor css --}}
@section('vendor-styles')
<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/charts/apexcharts.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/extensions/swiper.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/tables/datatable/datatables.min.css')}}">
@endsection
@section('page-styles')
<link rel="stylesheet" type="text/css" href="{{asset('css/pages/dashboard-ecommerce.css')}}">
@endsection

@section('content')
<!-- Dashboard Ecommerce Starts -->
<section id="customers">
   
    <h1>Clientes</h1>
    <!-- Zero configuration table -->
    <section id="basic-datatable">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Listado de Clientes</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body card-dashboard">                            
                            <div class="table-responsive">
                                <table class="table zero-configuration">
                                    <thead>
                                        <tr>
                                            <th>Nombre</th>
                                            
                                            <th>Email</th>
                                            <th>Estado</th>
                                            <th>Opciones</th>                                           
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($customers as $customer)
                                        <tr>
                                            <td>{{$customer->customer_name. ' '. $customer->customer_last_name}} </td>
                                            <td>{{$customer->customer_email}}</td>
                                            <td>{{$customer->customer_status}}</td>
                                            <td>
                                                <a href="{{route('viewcustomer', [$customer->idcustomer])}}" class="btn btn-primary"><i class="bx bx-show"></i></a>
                                                <a href="{{route('editcustomer', [$customer->idcustomer])}}" class="btn btn-warning"><i class="bx bxs-edit-alt"></i></a>
                                                <button href="" class="btn btn-danger" onclick="deletec({{$customer}})"><i class="bx bxs-trash"></i></button>
                                                <a href="{{route('reservations', [$customer->idcustomer])}}" class="btn btn-info"><i class="bx bx-task"></i></a>
                                            </td>                                            
                                        </tr>
                                        @endforeach
                                        
                                        
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Nombre</th>                                            
                                            <th>Email</th>
                                            <th>Estado</th>
                                            <th>Opciones</th>                                            
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <a class="btn btn-primary" href="{{ url()->previous() }}"><i class="bx bx-arrow-back"></i>Atrás</a>
    </section>
    <!--/ Zero configuration table -->
<!--Danger theme Modal -->
<div class="modal fade text-left" id="danger" tabindex="-1" role="dialog" aria-labelledby="myModalLabel120" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h3 class="modal-title white" id="modaltitle">¿Desea borrar a ?</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="bx bx-x"></i>
                </button>
            </div>
            <div class="modal-body">
                El usuario será marcado como inactivo. Luego podrá ser activado por un administrador.
                <p>Escribe el motivo por el cual este usuario será desactivado</p>
                <form method="POST" action="{{route('deletecustomer')}}">
                    @csrf
                <!-- Floating Label Textarea start -->
                <input type="hidden" name="status" value="inactive">
                <input type="hidden" id="idcustomerdelete" name="idcustomer" value="">
                <fieldset class="form-label-group">
                    <textarea class="form-control" id="label-textarea" rows="3" name="comment" placeholder="Comentario" required></textarea>
                    <label for="label-textarea">Comentario</label>
                </fieldset>
                <!-- Floating Label Textarea end -->
            
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-light-secondary" data-dismiss="modal">
                    <i class="bx bx-x d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Cancelar</span>
                </button>
                <button type="submit" class="btn btn-danger ml-1">
                    <i class="bx bx-check d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Confirmar</span>
                </button>
            </div>
            </form>
        </div>
    </div>
</div>
</div>
<div class="modal-info mr-1 mb-1 d-inline-block">
</section>

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
@endsection

@section('page-scripts')
<script src="{{asset('js/scripts/datatables/datatable.js')}}"></script>
<script>
    function deletec(customer){
        document.getElementById("modaltitle").innerHTML="¿Desea borrar a "+customer.customer_name+"?";
        document.getElementById("idcustomerdelete").value=customer.idcustomer;
        $("#danger").modal();
    }
</script>
@endsection

