<div class="col-xs-6">
    <!-- general form elements -->
    <div class="box box-primary">
    	
        <div class="box-header">
            <!-- tools box -->
            <div class="pull-right box-tools">
                <a class="btn btn-primary btn-sm pull-right" data-widget='collapse' data-toggle="tooltip" title="Collapse" style="margin-right: 5px;"><i class="fa fa-minus"></i></a>
                @if( isset($editorial->id) )
	                <a class="btn btn-sm bg-olive pull-right" href="{{ url('admin/editorial/edit') }}" style="margin-right: 5px;"><i class="fa fa-plus-square"></i>&nbsp;Agregar otro no. Editorial</a>
                @endif
            </div><!-- /. tools -->
            
            <i class="fa fa-edit"></i>
            <h3 class="box-title">Datos</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
            <form role="form" id="frm_edit" name="frm_edit" enctype="multipart/form-data" method="post">
                <input type="hidden" id="id" name="id" value="{{ isset($editorial->id)?$editorial->id:'' }}" readonly />
                <p><a href="#" class="btn bg-olive btn-lg save"><span>GUARDAR</span></a></p>
                
                <div class="form-group">
                	@if( isset($editorial->id) and is_file($editorial->path.$editorial->archivo) )
                        <img id="img_b" src="{{ asset($editorial->path.$editorial->archivo) }}" style="display:block; width:40%; margin: 2% auto;" /><br>
                    @else
                        <img id="img_b" src="{{ asset('img/list_nodisponible.jpg') }}" style="display:block; margin: 2% auto;" /><br>
                    @endif
                    <label>Imagen (Medidas de 480x630)</label>
                    <input type="file" name="imagen" onchange="previewImg(this,'img_b', '40%', 'auto')" class="form-control @if( !isset($editorial->archivo) or empty($editorial->archivo) ) validate[required] @endif" data-prompt-position="topLeft" placeholder="..." name="archivo" />
                </div>
                
                <!-- text input -->
                <div class="form-group">
                    <label>No. Publicación</label>
                    <input type="text" class="form-control validate[required, customer[integer]]" data-prompt-position="topLeft" placeholder="..." name="no_publicacion" value="{{{ Input::old('no_publicacion')?Input::old('no_publicacion'):(isset($editorial->no_publicacion)?$editorial->no_publicacion:'') }}}"/>
                </div>
                
                <div class="form-group">
                    <label>T&iacute;tulo</label>
                    <input type="text" class="form-control validate[required, maxSize[150]]" data-prompt-position="topLeft" placeholder="..." name="titulo" value="{{{ Input::old('titulo')?Input::old('titulo'):(isset($editorial->titulo)?$editorial->titulo:'') }}}"/>
                </div>
                <div class="form-group">
                    <label>Descripcion Corta</label>
                    <textarea class="form-control validate[required, maxSize[255]]" data-prompt-position="topLeft" id="descripcion" name="descripcion" rows="8" style="width:100%;">{{ Input::old('descripcion')?Input::old('descripcion'):(isset($editorial->descripcion)?$editorial->descripcion:'') }}</textarea>
                </div>
                <?php /*?><div class="form-group">
                    <label>Descripcion Larga</label>
                    <textarea id="descripcion_larga_es" name="descripcion_larga_es" rows="10" cols="80">{{ isset($editorial->descripcion_larga_es)?$editorial->descripcion_larga_es:'' }}</textarea>
                </div><?php */?>
                <div class="form-group">
                    <label>Url</label>
                    <input type="text" class="form-control validate[maxSize[255]]" data-prompt-position="topLeft" placeholder="..." name="url" value="{{{ Input::old('url')?Input::old('url'):(isset($editorial->url)?$editorial->url:'') }}}"/>
                </div>
                
                
                <p><a href="#" class="btn bg-olive btn-lg save"><span>GUARDAR</span></a></p>
            </form>
        </div><!-- /.box-body -->
    </div><!-- /.box -->
</div><!-- /.box -->