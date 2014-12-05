<div class="col-xs-5">
    <!-- general form elements -->
    <div class="box box-primary">
    	
        <div class="box-header">
            <!-- tools box -->
            <div class="pull-right box-tools">
                <a class="btn btn-primary btn-sm pull-right" data-widget='collapse' data-toggle="tooltip" title="Collapse" style="margin-right: 5px;"><i class="fa fa-minus"></i></a>
                @if( isset($proyecto->id) )
	                <a class="btn btn-sm bg-olive pull-right" href="{{ url('admin/productos/edit') }}" style="margin-right: 5px;"><i class="fa fa-plus-square"></i>&nbsp;Agregar otro producto</a>
                @endif
            </div><!-- /. tools -->
            
            <i class="fa fa-edit"></i>
            <h3 class="box-title">Datos</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
            <form role="form" id="frm_edit" name="frm_edit" enctype="multipart/form-data" method="post">
                <input type="hidden" id="id" name="id" value="{{ isset($proyecto->id)?$proyecto->id:'' }}" readonly />
                <p><a href="#" class="btn bg-olive btn-lg save"><span>GUARDAR</span></a></p>
                <div class="form-group" style="position:relative;">
                    <label>Categor&iacute;a</label>
                    @if( $cat->count() > 0 )
                    	@foreach($cat as $value)
                        	<?php $chk = false; ?>
                            @if( isset($proyecto->categorias) )
                            	@foreach($proyecto->categorias as $c)
                            		@if( $c->id==$value->id )
										<?php $chk = true; break; ?>
                                	@endif
                            	@endforeach
                            @endif
                            <p>{{ Form::checkbox('categoria_id[]', $value->id, $chk, array('class'=>'validate[required]')).' '.$value->nombre }}</p>
                        @endforeach
                    @endif
                </div>
                
                <!-- text input -->
                <div class="form-group">
                    <label>T&iacute;tulo</label>
                    <input type="text" class="form-control validate[required, maxSize[255]]" data-prompt-position="topLeft" placeholder="..." name="titulo" value="{{{ Input::old('titulo')?Input::old('titulo'):(isset($proyecto->titulo)?$proyecto->titulo:'') }}}"/>
                </div>
                <div class="form-group">
                    <label>Descripcion Corta</label>
                    <textarea class="form-control validate[required]" data-prompt-position="topLeft" id="descripcion" name="descripcion" rows="8" style="width:100%;">{{ Input::old('descripcion')?Input::old('descripcion'):(isset($proyecto->descripcion)?$proyecto->descripcion:'') }}</textarea>
                </div>
                <?php /*?><div class="form-group">
                    <label>Descripcion Larga</label>
                    <textarea id="descripcion_larga_es" name="descripcion_larga_es" rows="10" cols="80">{{ isset($proyecto->descripcion_larga_es)?$proyecto->descripcion_larga_es:'' }}</textarea>
                </div><?php */?>
                <div class="form-group">
                    <label>Locaci&oacute;n</label>
                    <input type="text" class="form-control validate[required, maxSize[100]]" data-prompt-position="topLeft" placeholder="..." name="locacion" value="{{{ Input::old('locacion')?Input::old('locacion'):(isset($proyecto->locacion)?$proyecto->locacion:'') }}}"/>
                </div>
                <div class="form-group">
                    <label>Tipolog&iacute;a</label>
                    <input type="text" class="form-control validate[required, maxSize[100]]" data-prompt-position="topLeft" placeholder="..." name="tipologia" value="{{{ Input::old('tipologia')?Input::old('tipologia'):(isset($proyecto->tipologia)?$proyecto->tipologia:'') }}}"/>
                </div>
                <div class="form-group">
                    <label>Cliente</label>
                    <input type="text" class="form-control validate[required, maxSize[150]]" data-prompt-position="topLeft" placeholder="..." name="cliente" value="{{{ Input::old('cliente')?Input::old('cliente'):(isset($proyecto->cliente)?$proyecto->cliente:'') }}}"/>
                </div>
                <div class="form-group">
                    <label>Status</label>
                    <input type="text" class="form-control validate[required, maxSize[100]]" data-prompt-position="topLeft" placeholder="..." name="status" value="{{{ Input::old('status')?Input::old('status'):(isset($proyecto->status)?$proyecto->status:'') }}}"/>
                </div>
                <div class="form-group">
                    <label>Asociado</label>
                    <input type="text" class="form-control validate[required, maxSize[150]]" data-prompt-position="topLeft" placeholder="..." name="asociado" value="{{{ Input::old('asociado')?Input::old('asociado'):(isset($proyecto->asociado)?$proyecto->asociado:'') }}}"/>
                </div>
                <div class="form-group">
                    <label>Dimensi&oacute;n</label>
                    <input type="text" class="form-control validate[required, maxSize[100]]" data-prompt-position="topLeft" placeholder="..." name="dimension" value="{{{ Input::old('dimension')?Input::old('dimension'):(isset($proyecto->dimension)?$proyecto->dimension:'') }}}"/>
                </div>
                
                <p><a href="#" class="btn bg-olive btn-lg save"><span>GUARDAR</span></a></p>
            </form>
        </div><!-- /.box-body -->
    </div><!-- /.box -->
</div><!-- /.box -->