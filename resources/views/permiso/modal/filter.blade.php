<div class="modal fade" id="m-open-modal-filter" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
	<div class="modal-dialog modal-primary modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Filtrar Permisos</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body">
				{{-- <form action="{{route('access.permiso.filter')}}" method="POST" enctype="multipart/form-data" class="form-horizontal">
					{{ csrf_field() }} --}}
					@include("permiso.form.frm_filter")
				{{-- </form> --}}
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>
	<!--Fin del modal-->
</div>