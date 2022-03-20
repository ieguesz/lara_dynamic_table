<div class="modal fade" id="m-open-change-status" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
	<div class="modal-dialog modal-primary modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Cambiar Permiso</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body">
				<form id="frm_cambio_estado" method="POST" enctype="multipart/form-data" class="form-horizontal">
					{{ method_field('delete') }}
                    {{ csrf_field() }}
                    @include("permiso.form.frm_change")
	            </form>
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>
	<!--Fin del modal-->
</div>