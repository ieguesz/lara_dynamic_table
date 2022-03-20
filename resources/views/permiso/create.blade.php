@extends('layouts.template')
@section('content')
<section class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1> Crear Permisos </h1>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="#" onclick="alertMetodoNoDisponible();">Principal</a></li>
					<li class="breadcrumb-item active">Permisos</li>
				</ol>
			</div>
		</div>
	</div>
</section>
<section class="content">
	@if(session()->has('correcto'))
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
	@endif
	<form id="frm-create" action="{{route('access.permiso.store')}}" method="POST">
		{{csrf_field()}}
		<div class="row">
			<div class="col-12">
				<div class="card card-secondary">
					<div class="card-header">
						<h3 class="card-title">Datos Del Usuario</h3>
					</div>
					<!-- /.card-header -->
					<!-- form start -->
					<div class="card-body">
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label for="P_descripccion_usuario">Usuario</label>
									<select id="P_descripccion_usuario" name="P_descripccion_usuario" class="form-control" >
									</select>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="id_operacion">Nombre Del Usuario <strong class="text-danger">*</strong></label>
									<input id="P_nombreUser" name="P_nombreUser" type="text"  class="form-control" autocomplete="off" placeholder="..."disabled/>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="id_transportista">Codigo De  Usuario <strong class="text-danger">*</strong></label>
									<input id="P_codigoUser" name="P_codigoUser" type="text" class="form-control" autocomplete="off" placeholder="..." disabled />
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-12">
				<div class="card card-secondary">
					<div class="card-header">
						<h3 class="card-title">Permisos</h3>
					</div>
					<!-- /.card-header -->
					<!-- form start -->
					<div class="card-body">
						<div class="row">
							<div class="col-4">
								<div class="form-group">
									<label for="P_descripcion_menu">Menu<strong class="text-danger">*</strong></label>
									<select id="P_descripcion_menu" name="P_descripcion_menu"class="form-control" >
						        	</select>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-12">
				<div class="card card-secondary">
					<div class="card-header">
						<div class="row">
							<div class="col-9"><h3 class="card-title">DETALLE | Lista De Permisos <strong class="text-white">*</strong></h3></div>
							<div class="col-3">
							<a id="P_agregar" class="btn btn-primary"><i class="fa fa-save"></i> Agregar Permiso</a>
							</div>
						</div>
					</div>
					<!-- /.card-header -->
					<!-- form start -->
					<div class="card-body">
						<div class="row">
							<div class="col-12">
								<div class="form-group">
									<p class="px-1" id="n-fila"> Número de filas [0/100]. </p>
								</div>
							</div>
						</div>
						<div class="well well-sm">
							<div class="table-responsive">
								<table id="detalles" class="table table-bordered table-striped table-sm">
									<thead>
										<tr class="bg-secondary">
											<th>Ítem</th>
											<th>Descripción</th>
											<th>Acción</th>
										</tr>
									</thead>
									{{-- <tfoot>
									<tr>
										<td colspan="6"></td>
									</tr>
									</tfoot> --}}
									<tbody>
									</tbody>
								</table>
							</div>
						</div>
						<div class="modal-footer">
							<a id="P_nuevo" href="{{ route('access.permiso.create') }}" class="btn btn-primary" style="display: none"><i class="far fa-credit-card fa-2x"></i> Nuevo Permisos
                            </a>
							<a id="P_cancelar"type="button" class="btn btn-danger"
							href="{{route('access.permiso.index')}}
							"><i class="fa fa-times fa-2x"></i> Cancelar </a>

							<button id="P_guardar" class="btn btn-primary" id="genera_movimiento"><i class="fa fa-save fa-2x"></i> Guardar </button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</form>
</section>
@endsection
@section('script')
<script type="text/javascript">
// "use strict"
$.fn.select2.defaults.set('language', 'es');
$(document).ready(function() {

	$("#P_descripccion_usuario").select2({
        width: '100%',
        theme: 'bootstrap4',
        placeholder: 'Selecciona un usuario',
        ajax: {
            url: "{{route('access.permiso.select2user')}}",
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
    }).on('select2:select',function(){
    	let userId = $("#P_descripccion_usuario").select2('data')[0].id
    	let userNombre = $("#P_descripccion_usuario").select2('data')[0].text
    	$("#P_nombreUser").val(userNombre)
    	$("#P_codigoUser").val(userId)
    })
	$("#P_descripcion_menu").select2({
        width: '100%',
        theme: 'bootstrap4',
        placeholder: 'Selecciona un menu',
        ajax: {
            url: "{{route('access.permiso.select2menu')}}",
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

    $("#P_agregar").on('click',function(e){
    	e.preventDefault()

    	if(!$("#P_descripcion_menu").val()){
            error_alert(
            	'Debes seleccionar un menu'
            	)
            return false;
        }

    	let menuId = $("#P_descripcion_menu").select2('data')[0].id
    	let menuNombre = $("#P_descripcion_menu").select2('data')[0].text
    	addRowTable(
    		menuId,
    		menuNombre,
    		1
    		);
    });

	$("#frm-create").on('submit',function(e) {
		e.preventDefault()

		if(!$("#P_descripccion_usuario").val()){
            error_alert(
            	'Debes seleccionar un usuario'
            	)
            return false;
        }

		if($("#detalles > tbody  > tr").length ==  0){
            error_alert(
            	'La tabla detalles no puede estar vacia'
                )
            return false;
          }
        disableButton(1)
        const jsonData = [];
        $('#detalles > tbody  > tr').each(function (index, tr) {

        	// para nuevos datos
	        if($(tr).find('td').eq(0).attr('data-new') == 1){
		        var item = {
		            "menuId": $(tr).find('td').eq(0).attr('data-id_menu'),
		         	"menuNombre": $(tr).find('td').eq(1).text(),
		        };
		        jsonData.push(item);
		    }
        });
        // console.log(jsonData);

        const url = "{{ route('access.permiso.store') }}";
        var formData = new FormData();
        formData.append('id_usuario', $("#P_descripccion_usuario").val());
        formData.append('detalle', JSON.stringify(jsonData));
        formData.append('_method', 'POST');

        // // debugger
        // for (let [key, value] of formData) {
        // console.log(`${key}: ${value}`)
        // }
        axios.post(url, formData)
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
            	//refresca pagina
            	document.getElementById("P_nuevo").click()
            }
            disableButton(0)


        }).catch(function (error) {
	    // handle error
		   console.log(error)
		    disableButton(0)
		})

	});

});

const esMenuRepetido = (codId) => {
    let esRepetido = 0;
    $('#detalles > tbody  > tr').each(function(index, tr) {
     // debugger
        if($(tr).find('td').eq(0).attr('data-id_menu') === codId){
            esRepetido = 1;
        }
    });
    return esRepetido;
}

var count = 1
const addRowTable = (menuId,menuNombre,nuevo) => {
	if(!esMenuRepetido(menuId)){
		let row = `<tr>
                   <td data-id_menu="${menuId}" data-new=${nuevo} ><h6>${count}</h6></td>
                   <td><h6>${menuNombre}</h6></td>
                   <td>
                       <center>
                       	<h6>
                           <a class="btn btn-primary btn-sm p_remover"><i class='fa fa-times'></i></a>
                        </h6>
                       </center>
                   </td>
                   </tr>`;
         count++
        $("#detalles tbody").append(row);
        $("#P_descripcion_menu").val('').trigger('change.select2')
    	}else{
    		error_alert(
    			'El menu ya se encuentra agregado en la lista'
    			)
    	}
    	$("#n-fila").html("Número de filas ["+$("#detalles tbody tr").length+"/100].");
}
const numeracionItem = () => {
    	count = 1
    	$('#detalles > tbody  > tr').each(function(index, tr) {
    		$(tr).find('td').eq(0).html(`<h6>${ count }</h6>`)
    		count++
    	});
    }
const disableButtonTable = (status) => {
    	$('#detalles > tbody  > tr').each(function(index, tr) {
    		// debugger
    		if(status){
	    		$(tr).find('td').eq(2).find('.p_remover')
	    		.css('pointer-events','none')
				.css('cursor','not-allowed')
				.css('opacity','0.65')
			}else{
				$(tr).find('td').eq(2).find('.p_remover')
				.css('pointer-events','')
				.css('cursor','')
				.css('opacity','')
			}
    	});
    }

const disableButton = (status) => {
	if(status){
		$('#P_cancelar')
		.css('pointer-events','none')
		.css('cursor','not-allowed')
		.css('opacity','0.65')

		$('#P_guardar').prop('disabled',true)
		// $('#P_agregar').prop('disabled', true)
		$('#P_agregar')
		.css('pointer-events','none')
		.css('cursor','not-allowed')
		.css('opacity','0.65')
		disableButtonTable(status)
		$('#P_descripccion_usuario').prop('disabled',true)
		$('#P_descripcion_menu').prop('disabled',true)
	}else{
		$('#P_cancelar')
		.css('pointer-events','')
		.css('cursor','')
		.css('opacity','')
		$('#P_guardar').prop('disabled',false)
		// $('#P_agregar').prop('disabled', false)
		// $('#P_agregar').removeAttr('style')
		$('#P_agregar')
		.css('pointer-events','')
		.css('cursor','')
		.css('opacity','')
		disableButtonTable(status)
		$('#P_descripccion_usuario').prop('disabled',false)
		$('#P_descripcion_menu').prop('disabled',false)
	}
}

$(document).on('click', '.p_remover', function(e){
    e.preventDefault()
    success_alert(
    			'Removido'
    			)
    // remueve la fila
    $(this).parents("tr").remove()
    //reajusta el contador de la primera fila
    numeracionItem()
    //cuenta las filas
	$("#n-fila").html("Número de filas ["+$("#detalles tbody tr").length+"/100].");
});

</script>
@endsection