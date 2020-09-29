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
   
    <h1>Servicios</h1>
    <!-- Zero configuration table -->
    <section id="basic-datatable">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Listado de Servicios</h4>
                        <a href="{{route('addservice')}}" class="btn btn-success">Agregar</a>
                    </div>
                    <div class="card-content">
                        <div class="card-body card-dashboard">                            
                            <div class="table-responsive">
                                <table class="table zero-configuration">
                                    <thead>
                                        <tr>
                                            <th>Nombre</th>                                            
                                            <th>Categoría</th>
                                            <th>Precio</th>
                                            <th>Opciones</th>                                           
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($services as $service)
                                        <tr>
                                            <td>{{$service->service_name}} </td>
                                            <td>{{$service->category->category_name}}</td>
                                            <td>{{$service->service_price}}</td>
                                            <td>
                                                <a href="{{route('viewservice', [$service->id_service])}}" class="btn btn-primary"><i class="bx bx-show"></i></a>
                                                <a href="{{route('editservice', [$service->id_service])}}" class="btn btn-warning"><i class="bx bxs-edit-alt"></i></a>
                                                <button href="" class="btn btn-danger" onclick="deletec({{$service}})"><i class="bx bxs-trash"></i></button>
                                                
                                            </td>                                            
                                        </tr>
                                        @endforeach
                                        
                                        
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Nombre</th>                                            
                                            <th>Categoría</th>
                                            <th>Precio</th>
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
<!--Delete Modal -->
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
                El servicio será marcado como inactivo. Luego podrá ser activado por un administrador.
                <p>Escribe el motivo por el cual este servicio será desactivado</p>
                <form method="POST" action="{{route('deleteservice')}}">
                    @csrf
                <!-- Floating Label Textarea start -->
                <input type="hidden" name="status" value="inactive">
                <input type="hidden" id="idservicedelete" name="idcustomer" value="">
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

<!--Add Modal -->
<div class="modal fade text-left" id="add" tabindex="-1" role="dialog" aria-labelledby="myModalLabel120" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h3 class="modal-title white" id="modaltitle">¿Desea borrar a ?</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="bx bx-x"></i>
                </button>
            </div>
            <div class="modal-body">
                El servicio será marcado como inactivo. Luego podrá ser activado por un administrador.
                <p>Escribe el motivo por el cual este servicio será desactivado</p>
                <form method="POST" action="{{route('deleteservice')}}">
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
<!--end add modal-->
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
    function deletec(service){
        document.getElementById("modaltitle").innerHTML="¿Desea borrar "+service.service_name+"?";
        document.getElementById("idservicedelete").value=service.id_service;
        $("#danger").modal();
    }
</script>
@endsection

