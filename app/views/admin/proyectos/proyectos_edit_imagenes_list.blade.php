@if( isset($proyecto) and count($proyecto->imagenes) > 0 )
    @foreach( $proyecto->imagenes as $img )
        @if( is_file($img->path.$img->archivo) )
            <div class="img-cont col-md-4" id="img_{{ $img->id }}" style="{{ isset($style)?$style:'' }}">
                <!-- Default box -->
                <div class="box">
                    <div class="box-header">
                        <?php /*?><h3 class="box-title">Default Box (button tooltip)</h3><?php */?>
                        <div class="box-tools pull-right">
                            <?php /*?><a class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></a><?php */?>
                        </div>
                    </div>
                    <div class="box-body">
                        <img src="{{ asset($img->path.'thumb_'.$img->archivo) }}" alt="{{{ $proyecto->titulo }}}" style="display:block; margin:1% auto; width:100%;"><br />
                            <span><label>Orden:&nbsp;</label><input type="text" name="orden[{{ $img->id }}]" size="4" value="{{ $img->ordering }}" class="validate[required, custom[integer]]" data-prompt-position="topLeft"/></span>&nbsp;
                            <br>
                            <p><textarea style="width:100%" class="validate[maxSize[150]]" name="descripcion[{{ $img->id }}]" data-prompt-position="topLeft">{{ $img->descripcion }}</textarea></p>
                            <span id="loader_order_img{{ $img->id }}">
                                
                                <a class="btn btn-primary btn-sm save-img" onclick="orderingImg('{{ $img->id }}');"><i class="fa fa-save"></i>&nbsp;Guardar</a>
                            </span>
                            <span id="loader_del_s{{ $img->id }}">
                                <a class="btn btn-danger btn-sm" title="" onclick="delImg('{{ $img->id }}');">
                                    <i class="fa fa-times"></i>
                                </a>
                            </span>
                    </div><!-- /.box-body -->
                    <div class="box-footer">&nbsp;</div><!-- /.box-footer-->
                </div><!-- /.box -->
            </div><!-- /.col -->
        @endif
    @endforeach
@endif