@section('scripts')
	<!--javascript-->
    <script src="{{ asset('scripts/jquery-1.7.1.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('scripts/main.js') }}" type="text/javascript"></script> 
    <script src="{{ asset('scripts/jquery.easytabs.min.js') }}" type="text/javascript"></script>
	<script src="{{ asset('scripts/jquery.hashchange.min.js') }}" type="text/javascript"></script>
	<!--<script src="{{ asset('scripts/jquery.tinycarousel.js') }}" type="text/javascript"></script>-->
	<script type="text/javascript" src="{{ asset('scripts/jquery.jcarousel.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('scripts/carousel.js') }}"></script>
    
    <script type="text/javascript" src="{{ asset('js/jquery.highlight.js') }}"></script>
    <?php /*?><script type="text/javascript" src="{{ asset('js/jquery.highlight-4.js') }}"></script><?php */?>
    <?php /*?><script type="text/javascript" src="{{ asset('js/jquery.highlight-4.closure.js') }}"></script><?php */?>
	<script type="text/javascript">
	var activeEditorial = false;
	function modalEditorial(){
		if (activeEditorial){
			var rutaImg='{{asset("images/vista-black.png")}}';
			$('.vista-gray').html('VISTA &nbsp;&nbsp;<img src="'+rutaImg+'" alt="[]">');
			activeEditorial=false;
			$('.modal-detalle').css({opacity: 1, visibility: "hidden"}).animate({opacity: 0}, 600, function() {});
		}else{
			var rutaImg='{{asset("images/close.png")}}';
			$('.vista-gray').html('CERRAR &nbsp;&nbsp;<img src="'+rutaImg+'" alt="[]">');
			activeEditorial = true;			
			$('.modal-detalle').css({ opacity: 0, visibility: "visible"}).animate({opacity: 1}, 600, function() {});
		}
	}
	</script>
	<script type="text/javascript">
	    $(document).ready( function() {
	    $('#tab-container').easytabs();

	      //Vista button
		$('.vista-gray').click(function(e){
			e.preventDefault();
			modalEditorial();
			//$('.modal-detalle').toggleClass('active');
		});

		//Vista detalle
		$('.detalle-editorial img').click(function(e){
			e.preventDefault();
			$('.detalle-editorial .detalle').toggleClass('active');
		})

	    });
    </script>
    <script type="text/javascript">
		/*$(document).ready(function()
		{
			$('#slider1').tinycarousel();
		});*/
		
	$(document).ready(function(e) {
        $('body').on('hover', '.hover-editorial', function(){
			
			$('.hover-editorial').children('span').removeClass('hide-num');
			$('.hover-editorial').children('img').remove();
			
			//Obtener json
			var datos 	= $(this).data('editorial');
			var pos		= $(this).data('pos');
			$('#pos_editorial').html(pos);
			
			/*{"id":4,"archivo":"edicion_2.jpg","no_publicacion":1,"titulo":"Design: El dise\u00f1o como estilo de vida","descripcion":"descripcion corta","url":null,"published":1,"removed":0,"created_at":"2014-12-11 11:11:20","updated_at":"2014-12-11 11:11:20","path":"uploads\/editorial\/id_4\/"}*/
			
			$(this).children('span').addClass('hide-num');
			$(this).append('<img src="'+datos.path+'thumb_'+datos.archivo+'" alt="">');
		});
		
		$('body').on('click', '.ver_detalle', function(e){
			e.preventDefault();
			var mi = $(this);
			$.ajax({
				type:		'post',
				cache:		false,
				dataType:	"json",
				url:		"{{ url('ajax-proyecto-detalles') }}",
				data:		'p_id='+mi.data('p_id'),
				beforeSend: function(){
				},
				
				error: function(){
					//close_lighbox();
					alert('Tuvimos un inconveniente, por favor intenta nuevamente');
				},
				
				success: function(data){
					
					if( data.success == true )
					{
						
						$('.conceptos .ver_detalle').removeClass('active');
						mi.addClass('active');
						
						$('#no_proyecto').html(mi.data('pos'));
												
						$('#img_proy').css({opacity: 1.0, visibility: "visible"}).animate({opacity: 0}, 400, function() {
							
							//spinner.stop();
							// Animation complete.
							$(this).html(function(){
								$(this).show();
								$(this).css({opacity: 0, visibility: "visible"}).animate({opacity: 1},400);
								
								
								return '<img src="'+data.proyecto.imagenes[0].path+data.proyecto.imagenes[0].archivo+'" alt="'+data.proyecto.titulo.toUpperCase()+'">';
							}).promise().done(function(){								
								//
							});
						});
						
						$('.titulo-main h3').html(data.proyecto.titulo.toUpperCase());
						
						//Ficha
						$('#arquitectura').html(data.proyecto.arquitectura.toUpperCase());
						$('#locacion').html(data.proyecto.locacion.toUpperCase());
						$('#tipologia').html(data.proyecto.tipologia.toUpperCase());
						$('#cliente').html(data.proyecto.cliente.toUpperCase());
						$('#status').html(data.proyecto.status.toUpperCase());
						$('#asociado').html(data.proyecto.asociado.toUpperCase());
						$('#dimension').html(data.proyecto.dimension.toUpperCase());
						$('#descripcion').html(data.proyecto.descripcion);
						
						var salida = '';
						
						if( data.proyecto.imagenes.length > 1 )
						{
							var i=0;
							$.each(data.proyecto.imagenes, function(index, value){
								if( i==0 ){ i++; return; }
								salida += '<div class="img-cont">';
								salida += '<img src="{{ url("") }}/'+value['path']+value['archivo']+'" alt="">';
								if( value['descripcion']=='' || value['descripcion']==null ){
								}
								else{
									salida+= '<p>'+value['descripcion']+'</p>';
								}
								salida+= '</div>'
							});
							
							if( salida!='' ){
								$('.detalle-imgs').html(salida);
							}
						}
						
						$('.section-pages-cont').children('div').slideUp('slow');
					}
					
					
				},
				
			});
			
		});
		
		$('body').on('click', '.filtro_cat', function(e){
			e.preventDefault();
			
			var mi = $(this);
			
			$.ajax({
				type:		'post',
				cache:		false,
				dataType:	"json",
				url:		"{{ url('ajax-filtro-categoria') }}",
				data:		'id='+mi.data('id'),
				beforeSend: function(){
					
				},
				
				error: function(){
					//close_lighbox();
					alert('Tuvimos un inconveniente, por favor intenta nuevamente');
				},
				
				success: function(data){
					
					if( data.success == true ){
						
						if( data.active == true ){
							mi.addClass('active');
						}
						else{
							mi.removeClass('active');
						}
						
						$('#no_proyecto').html('');
						
						$('.conceptos-inner').css({opacity: 1.0, visibility: "visible"}).animate({opacity: 0}, 400, function() {
							
							//spinner.stop();
							// Animation complete.
							$(this).html(function(){
								$(this).show();
								$(this).css({opacity: 0, visibility: "visible"}).animate({opacity: 1},400);
								
								
								return data.resp.view;
							}).promise().done(function(){								
								//
							});
						});
						
						$('#total_proyectos').html(data.resp.total_proyectos);
						
					}
					
				},
				
			});
			
		});
    });
	
	var timeout;
	$('body').on('keyup', '#search', function(e){
		if(timeout) {
			clearTimeout(timeout);
			timeout = null;
		}
		timeout = setTimeout(function(){ busqueda(); }, 800);
	});
	
	function busqueda()
	{
		$.ajax({
			type:		'post',
			cache:		false,
			dataType:	"json",
			url:		"{{ url('ajax-search') }}",
			data:		$('#frm_search').serialize(),
			beforeSend: function(){
				//
				$('.busqueda-resultados').slideUp('slow').promise().done(function(){
					//$(this).html('');
				});
				
			},
			
			error: function(){
				alert('Tuvimos un inconveniente, por favor intenta nuevamente');
			},
			
			success: function(data){
				//alert(data.view);
				if( data.success == true )
				{
					$('.busqueda-resultados').html(data.view).promise().done(function(){
						var busqueda = $('#search').val();
						var expr1 = /[^A-Za-zñÑáéíóúÁÉÍÓÚ0-9 ]/;
						var expr2 = /[ ]+/;
						busqueda = busqueda.replace(expr1, '');
						busqueda = busqueda.replace(expr2, ' ');
						
						var json = (busqueda.split(' '));
						//alert(json);
						$(".busqueda-resultados").highlight(json, { 
							caseSensitive: false,
							element: 'span', 
							className: 'highlight-search',
						});
							
						$(this).slideDown('slow');
						
					});
				}
				
				
			},
			
		});
		
	}
	
	//Obtener imagen aleatoria
	function changeBG(){
		$.ajax({
				type:		'post',
				cache:		false,
				dataType:	"json",
				url:		"{{ url('ajax-random-img') }}",
				//data:		'p_id='+mi.data('p_id'),
				beforeSend: function(){
					
				},
				
				error: function(){
					//close_lighbox();
					alert('Tuvimos un inconveniente, por favor intenta nuevamente');
				},
				
				success: function(data){
					
					if( data.success == true )
					{
						$('.conceptos .ver_detalle').removeClass('active');
						mi.addClass('active');
						
						$('#img_proy').css({opacity: 1.0, visibility: "visible"}).animate({opacity: 0}, 400, function() {
							
							//spinner.stop();
							// Animation complete.
							$(this).html(function(){
								$(this).show();
								$(this).css({opacity: 0, visibility: "visible"}).animate({opacity: 1},400);
								
								
								return '<img src="'+data.proyecto.imagen.path+data.proyecto.imagen.archivo+'" alt="'+data.proyecto.titulo.toUpperCase()+'">';
							}).promise().done(function(){								
								//
							});
						});
						
						$('.titulo-main h3').html(data.proyecto.titulo.toUpperCase());
						
						//Ficha
						$('#arquitectura').html(data.proyecto.arquitectura.toUpperCase());
						$('#locacion').html(data.proyecto.locacion.toUpperCase());
						$('#tipologia').html(data.proyecto.tipologia.toUpperCase());
						$('#cliente').html(data.proyecto.cliente.toUpperCase());
						$('#status').html(data.proyecto.status.toUpperCase());
						$('#asociado').html(data.proyecto.asociado.toUpperCase());
						$('#dimension').html(data.proyecto.dimension.toUpperCase());
						$('#descripcion').html(data.proyecto.descripcion);
						
					}
					
					
				},
				
			});
	}
	</script>
    
    <!-- include Cycle2 -->
	<script src="{{ asset('js/jquery.cycle2.min.js') }}"></script>
    <script type="text/javascript">
	$('.cycle-slideshow').cycle({ random: true, timeout:5000 });
    </script>
    
@show