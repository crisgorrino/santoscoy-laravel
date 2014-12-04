<div class="col-xs-7">
    <!-- general form elements disabled -->
    <div class="box box-primary">
        <div class="box-header">
            <!-- tools box -->
            <div class="pull-right box-tools">
                <a class="btn btn-primary btn-sm pull-right" data-widget='collapse' data-toggle="tooltip" title="Collapse" style="margin-right: 5px;"><i class="fa fa-minus"></i></a>
            </div><!-- /. tools -->
            
            <i class="fa fa-picture-o"></i>
            <h3 class="box-title">Im&aacute;genes</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
            <div id="ajax_msg_img"></div>
            
                @if( isset($proyecto->id) )
                    <form role="form" name="frm_add_img" id="frm_add_img" enctype="multipart/form-data" method="post">	
                        <input type="hidden" name="p_id" class="validate[required]" value="{{ $proyecto->id }}" />
                        <div class="row fileupload-buttonbar">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label>Im&aacute;genes (m&aacute;ximo de 1000px de ancho y m&aacute;ximo de 425px alto)</label><br>
                                    <span class="btn btn-success fileinput-button">
                                        <i class="glyphicon glyphicon-plus"></i>
                                        <span>Agregar im&aacute;genes...</span>
                                        <input type="file" name="files[]" multiple id="files" class="validate[required]" data-prompt-position="topLeft">
                                    </span>                                    
                                    <button class="btn btn-primary start" id="uploadAll" type="submit">
                                        <i class="glyphicon glyphicon-upload"></i>
                                        <span>Subir todo</span>
                                    </button>                                    
                                    <button type="reset" class="btn btn-warning cancel">
                                        <i class="glyphicon glyphicon-ban-circle"></i>
                                        <span>Cancelar todos</span>
                                    </button>
                                </div>
                                <!-- The global file processing state -->
                                <span class="fileupload-process"></span>
                                
                            </div>
                            <?php /*?><span id="ajax_loader_img"></span><?php */?>
                            
                            <div class="col-lg-5 fileupload-progress fade">
                                <!-- The global progress bar -->
                                <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                                    <div class="progress-bar progress-bar-success" style="width:0%;"></div>
                                </div>
                                <!-- The extended global progress state -->
                                <div class="progress-extended">&nbsp;</div>
                            </div>
                        </div>
                        
                        
                        <!-- The table listing the files available for upload/download -->
                        <table id="table_load_img" role="presentation" class="table table-striped"><tbody class="files"></tbody></table>
                    </form>
                    
                    <div class="row">
                        <form name="frm_elementos" id="frm_elementos" method="post">
                            <input type="hidden" name="p_id" class="validate[required]" value="{{ $proyecto->id }}" />
                            <div id="ajax_img"><?php /*?><pre><?php print_r($proyecto->imagenes); ?></pre><?php */?>
                                @if( isset($proyecto) and count($proyecto->imagenes) > 0 )
                                    @foreach( $proyecto->imagenes as $img )
                                        @if( is_file($img->path.$img->archivo) )
                                            <div class="img-cont col-md-4" id="img_{{ $img->id }}">
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
                            </div>
                        </form>  
                    </div>
                @else
                    <h3 style="text-align: center;">Imagen del proyecto</h3>
                    <p style="text-align: center;">Para agregar im&aacute;genes primero guarda el registro</p>
                    <img style="display: block; margin: 0 auto;" src="{{ asset('img/detalle_nodisponible.jpg') }}" alt="Imagen no disponible" />
                @endif
            
        </div><!-- /.box-body -->
    </div><!-- /.box -->
</div>