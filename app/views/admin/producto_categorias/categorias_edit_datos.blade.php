<div class="col-xs-12">
    <!-- general form elements -->
    <div class="box box-primary">
    	
        <div class="box-header">
            <!-- tools box -->
            <div class="pull-right box-tools">
                <a class="btn btn-primary btn-sm pull-right" data-widget='collapse' data-toggle="tooltip" title="Collapse" style="margin-right: 5px;"><i class="fa fa-minus"></i></a>
                @if( isset($categoria->id) )
	                <a class="btn btn-sm bg-olive pull-right" href="{{ url('admin/productos/categorias/edit') }}" style="margin-right: 5px;"><i class="fa fa-plus-square"></i>&nbsp;Agregar otra categor&iacute;a</a>
                @endif
            </div><!-- /. tools -->
            
            <i class="fa fa-edit"></i>
            <h3 class="box-title">Datos</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
            <form role="form" id="frm_edit" name="frm_edit" method="post">
                <input type="hidden" id="id" name="id" value="{{ isset($categoria->id)?$categoria->id:'' }}" readonly="readonly" />
                <p><a href="#" class="btn bg-olive btn-lg save"><span>GUARDAR</span></a></p>
                
                <div class="form-group" style="position:relative;">
                    <label>G&eacute;nero</label>
                    <select class="form-control validate[required]" data-prompt-position="topLeft" name="tipo" id="tipo">
                        <option value="">Seleccionar...</option>
                        <option value="hombre" @if( Input::old('tipo')=='hombre' or (isset($categoria->tipo) and $categoria->tipo=='hombre') ) selected="selected" @endif>Hombre</option>
                        <option value="mujer" @if( Input::old('tipo')=='mujer' or (isset($categoria->tipo) and $categoria->tipo=='mujer') ) selected="selected" @endif>Mujer</option>
                    </select>
                </div>
                
                <!-- text input -->
                <div class="form-group">
                    <label>Nombre</label>
                    <input type="text" class="form-control validate[required]" data-prompt-position="topLeft" placeholder="..." name="nombre" value="{{{ Input::old('nombre')?Input::old('nombre'):(isset($categoria->nombre)?$categoria->nombre:'') }}}"/>
                </div>
                
                <p><a href="#" class="btn bg-olive btn-lg save"><span>GUARDAR</span></a></p>
            </form>
        </div><!-- /.box-body -->
    </div><!-- /.box -->
</div><!-- /.box -->