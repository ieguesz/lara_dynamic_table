@extends('layouts.template')
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Permisos</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#" onclick="alertMetodoNoDisponible();">Principal</a></li>
                    <li class="breadcrumb-item active">Permisos</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
    </section>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
       {{--  @if(session()->has('correcto'))
            <div class="alert alert-success">
                {{ session()->get('correcto') }}
            </div>
        @endif
        @if(session()->has('error'))
            <div class="alert alert-danger">
                {{ session()->get('error') }}
            </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif --}}
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header no-print">
                        <div class="col-12">
                            <a class="btn btn-default" data-toggle="modal" data-target="#m-open-modal-filter"><i class="fas fa-filter" ></i></a>
                            <a href="{{ route('access.permiso.create') }}" class="btn btn-primary float-right"><i class="far fa-credit-card"></i> Nuevo Permisos
                            </a>
                            {{--                            <a href="?c=material&a=showReport" class="btn btn-success float-right" style="margin-right: 5px;">
                                <i class="fas fa-download"></i> Generate Reporte
                            </a> --}}
                        </div>
                        {{--    <div class="text-left">
                            <a class="btn btn-primary" href="?c=material&a=ConsultaCrud">+</a>
                        </div> --}}
                    </div>
                    <div class="card-body">
                        <div class="well well-sm">
                            <div class="table-responsive">
                                <table id="tablePermisoIndex" class="table table-striped table-bordered table-sm" style="width:100%">
                                    <thead>
                                        <!--tabla sus columnas-->
                                        <tr>
                                            <th>#</th>
                                            <th>Fecha</th>
                                            <th>Nombre</th>
                                            <th>Estado</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!--Finalizar el foreach-->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
        </div>
    </section>
    @include('permiso.modal.filter', ["modulo" => "1"])
    @include('permiso.modal.change', ["modulo" => "1"])
    @include('permiso.modal.view', ["modulo" => "1"])
@endsection
@section('script')
<script type="text/javascript">
$(document).ready(function(){
    filtrarRegistros()

    $("#P_fil_user").select2({
        width: '100%',
        theme: 'bootstrap4',
        // placeholder: 'Selecciona un usuario',
        ajax: {
            url: "{{route('access.permiso.select2filter_user')}}",
            type: "get",
            dataType: 'json',
            delay: 250,
            data: function(params) {
                return {
                    searchTerm: params.term,
                };
            },
            processResults: function(response) {
                return {
                    results: response
                };
            },
        }
    })

    $("#P_fil_menu").select2({
        width: '100%',
        theme: 'bootstrap4',
        // placeholder: 'Selecciona un menu',
        ajax: {
            url: "{{route('access.permiso.select2filter_menu')}}",
            type: "get",
            dataType: 'json',
            delay: 250,
            data: function(params) {
                return {
                    searchTerm: params.term,
                };
            },
            processResults: function(response) {
                return {
                    results: response
                };
            },
        }
    })
    $("#P_fil_estado").select2({
        width: '100%',
        theme: 'bootstrap4'
    });
});

$('#m-open-change-status').on('show.bs.modal', function (event) {
        //console.log('modal abierto');
        let button = $(event.relatedTarget);
        let url = button.data('url');
        let modal = $(this);
        // modal.find('.modal-body #frm_cambio_estado').attr('action',url);
        modal.find('.modal-body #url').val(url);

});

$(document).on('submit', '#frm_cambio_estado',  function(e){
    e.preventDefault()
    let url = $("#frm_cambio_estado > #url").val()
    axios.delete(url)
    .then(function (response) {

        if (response.data.error) {
            error_alert(
                response.data.error
                )
            console.log(response.data.error)
        } else {
            success_alert(
                response.data.msg
                )
            console.log(response.data.msg)
            $("#m-open-change-status").modal('hide')
            filtrarRegistros()
        }
    }).catch(function (error) {
    // handle error
       console.log(error)
    })
});

$(document).on('click', '#btn_idx_filter',  function(e){
    $("#m-open-modal-filter").modal('hide')
    filtrarRegistros()
});

$(document).on('click', '#btn_idx_clear',  function(e){
    $("#P_fil_inicio_fecha").val('')
    $("#P_fil_termino_fecha").val('')
    $("#P_fil_user").val('').trigger('change')
    $("#P_fil_menu").val('').trigger('change')
    $("#P_fil_estado").val('').trigger('change')
    filtrarRegistros()
});

const filtrarRegistros = () => {
        var data = {
            "P_fil_inicio_fecha"  :$("#P_fil_inicio_fecha").val(),
            "P_fil_termino_fecha" :$("#P_fil_termino_fecha").val(),
            "P_fil_user"          :$("#P_fil_user").val(),
            "P_fil_menu"          :$("#P_fil_menu").val(),
            "P_fil_estado"        :$("#P_fil_estado").val(),
        }
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // var height = $(".content-wrapper").height() - $(".box.box-info").height() - 125;
        // console.log(height);

        var urlPermiso = "{{route('access.permiso.filter')}}";
        var tabla = $('#tablePermisoIndex').DataTable( {
            // "scrollY": true,
            // "scrollX": true,
            "ordering": true,
            "scrollCollapse": true,
            "pageLength" : 50,
            "lengthMenu": [ [50, 100, 150, -1], [50, 100, 150, "TODOS"] ],
            "language":{
                "sProcessing":     '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Procesando...</span> ',
                "sLengthMenu":     "Mostrar _MENU_ registros",
                "sZeroRecords":    "No se encontraron resultados",
                "sEmptyTable":     "Ningún dato disponible en esta tabla",
                "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
                "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                "sInfoPostFix":    "",
                "sSearch":         "Buscar:",
                "sUrl":            "",
                "sInfoThousands":  ",",
                "sLoadingRecords": "Cargando...",
                "oPaginate": {
                    "sFirst":    "Primero",
                    "sLast":     "Último",
                    "sNext":     "Siguiente",
                    "sPrevious": "Anterior"
                },
                "oAria": {
                    "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                    "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                }
            },
            // language:language.languageDataTables(),
            // dom:'<"div-longitud col-md-4"l><"div-botones col-md-4 text-center"B><"div-filtrado col-md-4"f>rt<"div-indice col-md-6"i><"div-paginacion col-md-6"p><"clear">',
            "ajax": {
                "url": urlPermiso,
                "type": "POST",
                "data": data
            },
            columns: [
                {data: 'id'},
                {data: 'fecha_registro'},
                {data: 'nombre'},
                {data: 'estado'},
                {data: 'action'},
            ],
            buttons: [{
              extend: 'excelHtml5',
              text: '<i class="fa fa-file-excel-o"></i>',
              titleAttr: 'Exportar a Excel',
              title: 'Listado de Usuarios por empresa',
              className: 'btn btn-success btn-sm',
              exportOptions: {
                columns: [0, 1, 2, 3, 4]
              },
              autoFilter: true
            }],
            destroy: true,
            responsive:true
        } );
    }
</script>
@endsection