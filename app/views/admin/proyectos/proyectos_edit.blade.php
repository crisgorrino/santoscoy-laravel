@extends('admin.layouts.admin_master')

@section('title') Productos @stop
@section('header-title') <h1>Productos <small>@if( $proyecto )Editar @else Agregar @endif</small></h1> @stop
@section('menu-proyectos-active') active @stop
@section('proyectos-active') active @stop

@section('breadcrumb')
	<li class="active">Productos</li>
@stop

@section('content') 
	<div class="row">
    		<?php /*?><div class="alert alert-danger alert-dismissable">
                <i class="fa fa-ban"></i>
                <a type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</a>
                <b>Alert!</b> Danger alert preview. This alert is dismissable. A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart.
            </div>
            <div class="alert alert-info alert-dismissable">
                <i class="fa fa-info"></i>
                <a type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</a>
                <b>Alert!</b> Info alert preview. This alert is dismissable.
            </div>
            <div class="alert alert-warning alert-dismissable">
                <i class="fa fa-warning"></i>
                <a type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</a>
                <b>Alert!</b> Warning alert preview. This alert is dismissable.
            </div>
            <div class="alert alert-success alert-dismissable">
                <i class="fa fa-check"></i>
                <a type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</a>
                <b>Alert!</b> Success alert preview. This alert is dismissable.
            </div><?php */?>
        @if ( $errors->count() > 0 )
        	<div class="desvanecer alert alert-danger alert-dismissable">
                <i class="fa fa-ban"></i>
                <a type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</a>
                <p>Errores encontrados : 
                	<ul>
                        @foreach( $errors->all() as $key =>$value )
                          <li>{{ $value }}</li>
                        @endforeach
                    </ul>
                </p>
            </div>
        @endif
        
    	@if( Session::has('msg') )
	        {{ Session::get('msg') }}            
	    @endif
        @include('admin.proyectos.proyectos_edit_datos')
        @include('admin.proyectos.proyectos_edit_imagenes')
        </div>
    <div>
@stop

@section('scripts')
	@parent
    
    <!-- CK Editor -->
    <script src="{{ asset('AdminLTE/js/plugins/ckeditor/ckeditor.js') }}" type="text/javascript"></script>
    <script type="text/javascript">
		$(function() {
			if ($("#descripcion_larga_es").length > 0){
				// Replace the <textarea id="editor1"> with a CKEditor
				// instance, using default configuration.
				CKEDITOR.replace('descripcion_larga_es');
				//bootstrap WYSIHTML5 - text editor
				//$(".textarea").wysihtml5();
			}
		});
	</script>
    
    <!-- Para JAlerts -->
    <?php /*?><script src="{{ asset('js/jqueryAlerts/jquery-1.8.2.js') }}" type="text/javascript"></script><?php */?>
    <script src="{{ asset('js/jqueryAlerts/jquery.ui.draggable.js') }}" type="text/javascript"></script>
    <!-- Core files -->
    <script src="{{ asset('js/jqueryAlerts/jquery.alerts.js') }}" type="text/javascript"></script>
    <link href="{{ asset('js/jqueryAlerts/jquery.alerts.css') }}" rel="stylesheet" type="text/css" media="screen" />
    <!-- Fin JAlerts -->
    
    <!--jQuery Validation Engine -->
    <link rel="stylesheet" href="{{ asset('js/jQuery-Validation-Engine/css/validationEngine.jquery.css') }}" type="text/css"/>
    <?php /*?><script src="{{ asset('js/jQuery-Validation-Engine/js/jquery-1.8.2.min.js') }}" type="text/javascript"></script><?php */?>
    <script src="{{ asset('js/jQuery-Validation-Engine/js/languages/jquery.validationEngine-es.js') }}" type="text/javascript" charset="utf-8"></script>
    <script src="{{ asset('js/jQuery-Validation-Engine/js/jquery.validationEngine.js') }}" type="text/javascript" charset="utf-8"></script>
    <script type="text/javascript">
		$(document).ready(function(e) {
            $("#frm_edit, #frm_elementos").validationEngine({ 
				autoPositionUpdate:true,
                focusFirstField : true ,
                validateNonVisibleFields:false,
                updatePromptsPosition: true,
                scroll:false,
                autoHidePrompt: true,
                autoHideDelay: 5000,
                fadeDuration: 400
			});
        });
	</script>
    <!--jQuery Validation Engine -->
            
    <!-- Spinner -->
    <script src="{{ asset('js/spin.min.js') }}"></script>
    <script type="text/javascript" language="javascript">
    var optsSpin = {
      lines: 13, // The number of lines to draw
      length: 4, // The length of each line
      width: 3, // The line thickness
      radius: 7, // The radius of the inner circle
      corners: 1, // Corner roundness (0..1)
      rotate: 0, // The rotation offset
      direction: 1, // 1: clockwise, -1: counterclockwise
      color: '#000', // #rgb or #rrggbb
      speed: 1, // Rounds per second
      trail: 60, // Afterglow percentage
      shadow: false, // Whether to render a shadow
      hwaccel: false, // Whether to use hardware acceleration
      className: 'spinner', // The CSS class to assign to the spinner
      zIndex: 2e9, // The z-index (defaults to 2000000000)
      top: '80px', // Top position relative to parent in px
      left: '50%' // Left position relative to parent in px
    };
    </script>
    <!-- Spinner -->
    
    <script type="text/javascript">
	$(document).ready(function() {
        $('.save').click(function(e){
			e.preventDefault();
			
			if( $("#frm_edit").validationEngine('validate') )
			{
				$('#frm_edit').submit();
			}
			
		});
    });
	</script>
    
    @if( isset($proyecto->id) )
        <!-- Agregar o eliminar img con ajax -->
        <script type="text/javascript">		
        $(document).ready(function(e) {
            
            // Subir texto y archivos de formularios al mismo tiempo con Ajax y jQuery
            $.fn.formajax = function(i){
                // this formulario
                var a = $(this);
                // url
                var b = i.url;
                // success
                var c = i.success;
                
                var e = i.error;
				
				var bs = i.beforeSend;
                
                var dt= i.dataType;
            
                a.each(function(){
                    // this formulario específico
                    var d = $(this);
                    // Encontramos el botón Enviar del formulario al que le hicimos click
                    //##############d.find('input[type="submit"]').click(function(e){
                        // Prevenimos que recargue la página
                        //##############e.preventDefault();    
                        // Creamos un formdata                
                        formdata = new FormData();
                        // En el formdata colocamos todos los archivos que vamos a subir
                        for (var i = 0; i < (d.find('input[type=file]').length); i++) { 
                            // buscará todos los input con el valor "file" y subirá cada archivo. Serán diferenciados en el PHP gracias al "name" de cada uno.
                            formdata.append((d.find('input[type="file"]').eq(i).attr("name")),((d.find('input[type="file"]:eq('+i+')')[0]).files[0]));            
                        }
                            
                        for (var i = 0; i < (d.find('input').not('input[type=file]').not('input[type=submit]').length); i++) { 
                            // buscará todos los input menos el valor "file" y "sumbit . Serán diferenciados en el PHP gracias al "name" de cada uno.
                            formdata.append( (d.find('input').not('input[type=file]').not('input[type=submit]').eq(i).attr("name")),(d.find('input').not('input[type=file]').not('input[type=submit]').eq(i).val()) );            
                        }
            
                        // Arrancamos el ajax    
                        $.ajax({
                            url: b,
                            type: "POST",
                            contentType: false,
                            data:formdata,
                            //dataType: dt,
                            processData:false,
							beforeSend: bs,
                            error: e,
                            success: c 
                        });// fin de ajax    
                    //##############}) ; // fin de click 
                }); //fin del each
            }; // fin de la funcion
			
        });
		
		var optsSpinDel = {
			  lines: 10, // The number of lines to draw
			  length: 4, // The length of each line
			  width: 3, // The line thickness
			  radius: 5, // The radius of the inner circle
			  corners: 1, // Corner roundness (0..1)
			  rotate: 0, // The rotation offset
			  direction: 1, // 1: clockwise, -1: counterclockwise
			  color: '#000', // #rgb or #rrggbb
			  speed: 1, // Rounds per second
			  trail: 60, // Afterglow percentage
			  shadow: false, // Whether to render a shadow
			  hwaccel: false, // Whether to use hardware acceleration
			  className: 'spinner_del', // The CSS class to assign to the spinner
			  zIndex: 2e9, // The z-index (defaults to 2000000000)
			  top: 'auto', // Top position relative to parent in px
			  left: 'auto' // Left position relative to parent in px
			};
			
		function delImg(img_id){
			
			//jConfirm('&iquest;Est&aacute;s seguro de Guardar el Comentario?', 'ALERTA', function(r){
			if( confirm('¿Estás seguro de Eliminar La imagen?') ){
								
				//var img_id = $(this).data('id');
				var p_id = '{{{ $proyecto->id }}}';
					
				$.ajax({
						type: "post",
						url: '{{ url("admin/proyectos/ajax-delete-img") }}',
						data: 'img_id='+img_id+'&p_id='+p_id,
						dataType: 'json',
						beforeSend: function(){
							//
							/*if (typeof spinnerImg != "undefined")
							{
								spinnerImg.stop();
							}
							spinnerImg = new Spinner(optsSpinDel).spin(document.getElementById("loader_del_s"+img_id));*/
							
						},
						error: function(datos){
							//spinnerImg.stop();
							alert('Error, no se eliminó.');
							//return false;
						},
						success:function(datos){
							//spinnerImg.stop();
							
							if( datos.success ){
								
								$('#img_'+datos.img_id).fadeOut('fast', function() {
									$(this).remove();
								});
								
							}					
							
						}
					});// fin de ajax
				
			}
			else{
					//return false;
				}
			//});
		}
		
		//Orden Elementos
		function orderingImg(img_id){
			
			//loader_order_img
			
			if( $('#frm_elementos').validationEngine('validate') ){
					
				$("#frm_elementos").formajax({
					type: "post",
					url:"{{ url('admin/proyectos/ajax-ordering-img') }}",
					dataType: "json",
					beforeSend: function(){
						//
						if (typeof spinnerO != "undefined")
						{
							spinnerO.stop();
						}
						spinnerO = new Spinner(optsSpin).spin(document.getElementById("loader_order_img"+img_id));
						
						return true;
						
					},
					error: function(xhr, error){
						//console.debug(xhr); console.debug(error);
						spinnerO.stop();
						alert('Error: '+error);
					 },
					success:function(datos){
						
						spinnerO.stop();
						
						if( datos.success ){
							$('#ajax_img').html(datos.salida);
							//$('#img_'+datos.img_id).fadeIn('slow');
							$('.img-cont').fadeIn('slow');
						}
						
						
					}
				}); // formajax
				
			}
			else{
				return false;
			}
			
		}
        </script>
        
        
        <!-- The template to display files available for upload -->
		<script id="template-upload" type="text/x-tmpl">
        {% for (var i=0, file; file=o.files[i]; i++) { %}
            <tr class="template-upload fade">
                <td>
                    <span class="preview"></span>
                </td>
                <td>
                    <p class="name">{%=file.name%}</p>
                    <strong class="error text-danger"></strong>
                </td>
                <td>
                    <p class="size">Processing...</p>
                    <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"><div class="progress-bar progress-bar-success" style="width:0%;"></div></div>
                </td>
                <td>
                    {% if (!i && !o.options.autoUpload) { %}
                        <button class="btn btn-primary start" disabled>
                            <i class="glyphicon glyphicon-upload"></i>
                            <span>Subir</span>
                        </button>
                    {% } %}
                    {% if (!i) { %}
                        <button class="btn btn-warning cancel">
                            <i class="glyphicon glyphicon-ban-circle"></i>
                            <span>Cancelar</span>
                        </button>
                    {% } %}
                </td>
            </tr>
        {% } %}
        </script>
        <!-- The template to display files available for download -->
		<script id="template-download" type="text/x-tmpl">
        {% for (var i=0, file; file=o.files[i]; i++) { %}
            <tr class="template-download fade">
                <td>
                    <span class="preview">
                        {% if (file.thumbnailUrl) { %}
                            <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" data-gallery><img src="{%=file.thumbnailUrl%}" style="width:80px;"></a>
                        {% } %}
                    </span>
                </td>
                <td>
                    <p class="name">
                        {% if (file.url) { %}
                            <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" {%=file.thumbnailUrl?'data-gallery':''%}>{%=file.name%}</a>
                        {% } else { %}
                            <span>{%=file.name%}</span>
                        {% } %}
                    </p>
                    {% if (file.error) { %}
                        <div><span class="label label-danger">Error</span> {%=file.error%}</div>
                    {% } %}
                </td>
                <td>
                    <span class="size">{%=o.formatFileSize(file.size)%}</span>
                </td>
                <td>
                    {% if (file.deleteUrl) { %}
                        <?php /*?><button class="btn btn-danger delete" data-type="{%=file.deleteType%}" data-url="{%=file.deleteUrl%}"{% if (file.deleteWithCredentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}>
                            <i class="glyphicon glyphicon-trash"></i>
                            <span>Delete</span>
                        </button>
                        <input type="checkbox" name="delete" value="1" class="toggle"><?php */?>
                    {% } else { %}
                        <button class="btn btn-warning cancel">
                            <i class="glyphicon glyphicon-ban-circle"></i>
                            <span>Cancelar</span>
                        </button>
                    {% } %}
                </td>
            </tr>
        {% } %}
        </script>
        <!-- CSS to style the file input field as button and adjust the Bootstrap progress bars -->
		<link rel="stylesheet" href="{{ asset('js/jQuery-File-Upload/css/jquery.fileupload.css') }}">
		<link rel="stylesheet" href="{{ asset('js/jQuery-File-Upload/css/jquery.fileupload-ui.css') }}">
		<!-- CSS adjustments for browsers with JavaScript disabled -->
		<noscript><link rel="stylesheet" href="{{ asset('js/jQuery-File-Upload/css/jquery.fileupload-noscript.css') }}"></noscript>
		<noscript><link rel="stylesheet" href="{{ asset('js/jQuery-File-Upload/css/jquery.fileupload-ui-noscript.css') }}"></noscript>
        <!-- The jQuery UI widget factory, can be omitted if jQuery UI is already included -->
		<script src="{{ asset('js/jQuery-File-Upload/js/vendor/jquery.ui.widget.js') }}"></script>
        <!-- The Templates plugin is included to render the upload/download listings -->
        <script src="{{ asset('js/jQuery-File-Upload/vendor/JavaScript-Templates/js/tmpl.min.js') }}"></script>
        <!-- The Load Image plugin is included for the preview images and image resizing functionality -->
        <script src="{{ asset('js/jQuery-File-Upload/vendor/JavaScript-Load-Image/js/load-image.all.min.js') }}"></script>
        <!-- The Canvas to Blob plugin is included for image resizing functionality -->
        <script src="{{ asset('js/jQuery-File-Upload/vendor/JavaScript-Canvas-to-Blob/js/canvas-to-blob.min.js') }}"></script>
        <?php /*?><!-- Bootstrap JS is not required, but included for the responsive demo navigation -->
        <script src="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script><?php */?>
        <!-- blueimp Gallery script -->
        <script src="{{ asset('js/jQuery-File-Upload/vendor/Gallery/js/jquery.blueimp-gallery.min.js') }}"></script>
        <!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
        <script src="{{ asset('js/jQuery-File-Upload/js/jquery.iframe-transport.js') }}"></script>
        <!-- The basic File Upload plugin -->
        <script src="{{ asset('js/jQuery-File-Upload/js/jquery.fileupload.js') }}"></script>
        <!-- The File Upload processing plugin -->
        <script src="{{ asset('js/jQuery-File-Upload/js/jquery.fileupload-process.js') }}"></script>
        <!-- The File Upload image preview & resize plugin -->
        <script src="{{ asset('js/jQuery-File-Upload/js/jquery.fileupload-image.js') }}"></script>
        <!-- The File Upload audio preview plugin -->
        <script src="{{ asset('js/jQuery-File-Upload/js/jquery.fileupload-audio.js') }}"></script>
        <!-- The File Upload video preview plugin -->
        <script src="{{ asset('js/jQuery-File-Upload/js/jquery.fileupload-video.js') }}"></script>
        <!-- The File Upload validation plugin -->
        <script src="{{ asset('js/jQuery-File-Upload/js/jquery.fileupload-validate.js') }}"></script>
        <!-- The File Upload user interface plugin -->
        <script src="{{ asset('js/jQuery-File-Upload/js/jquery.fileupload-ui.js') }}"></script>
        <!-- The main application script -->
        <?php /*?><script src="{{ asset('js/jQuery-File-Upload/js/main.js') }}"></script><?php */?>
        <script type="text/javascript">
		$(function () {
			$('#frm_add_img').fileupload({
				// Uncomment the following to send cross-domain cookies:
				//xhrFields: {withCredentials: true},
				url: "{{ url('admin/proyectos/ajax-add-img')}}",					
				success: function(data){
					//alert(data.salida);
					if( data.success == true && data.salida!='' ){
						
						$('#ajax_img').html(data.salida);
						
						$('.img-cont').each(function(index){
							$(this).delay(500*index).fadeIn(1500);
						});
					}
					
				}
			});
			
			// Enable iframe cross-domain access via redirect option:
			$('#frm_add_img').fileupload(
				'option',
				'redirect',
				window.location.href.replace(
					/\/[^\/]*$/,
					'/cors/result.html?%s'
				)
			);
			
			$('#frm_add_img').addClass('fileupload-processing');
			$.ajax({
				// Uncomment the following to send cross-domain cookies:
				//xhrFields: {withCredentials: true},
				url: $('#frm_add_img').fileupload('option', 'url'),
				dataType: 'json',
				context: $('#frm_add_img')[0],
				/*add: function (e, data) {
					$("#uploadAll").on('click',function () {
						data.submit();
					});
				}*/
			}).always(function () {
				$(this).removeClass('fileupload-processing');
			}).done(function (data) {
				
				//alert(data.salida);
				//$('#ajax_img').html(data.salida);
				
				$(this).fileupload('option', 'done').call(this, $.Event('done'), {result: data });
			});
			
		});
		</script>
    @endif
@stop