<div class="row">
    <div class="col-md-3" style="display:none;">
        <div class="form-group">
            <input id="fil_filter" type="hidden" value="ALL">
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label for="P_fil_inicio_fecha">Inicio del registro</label>
            <input id="P_fil_inicio_fecha" type="date" class="form-control tail-datetime-field text-center" value="" autocomplete="off">
        </div>
    </div>
     <div class="col-md-3">
        <div class="form-group">
            <label for="P_fil_termino_fecha">Termino del registro</label>
            <input id="P_fil_termino_fecha" type="date" class="form-control tail-datetime-field text-center" value="" autocomplete="off">
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label for="P_fil_user">Usuario</label>
            <select id="P_fil_user" class="form-control" >
                <option value="" >-- TODOS --</option>
            </select>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label for="P_fil_menu">Menus</label>
            <select id="P_fil_menu" class="form-control"  >
                <option value="" >-- TODOS --</option>
            </select>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label for="P_fil_estado">Estado</label>
            <select id="P_fil_estado" class="form-control" >
                <option value="">-- TODOS --</option>
                <option value="ACTV">ACTIVO</option>
                <option value="DESC">DESACTIVADO</option>
            </select>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times fa-2x"></i> Cerrar</button>
    <button id="btn_idx_clear" class="btn btn-primary"><i class="fa fa-undo fa-2x"></i> Limpiar</button>
    <button id="btn_idx_filter" class="btn btn-success"><i class="fa fa-save fa-2x"></i> Guardar</button>
</div>