@section('body')
<div class="main complete">
	  
	  <!--filtros-->
	  <div class="filtros complete">
		  <a href="" class="filtro_cat @if(Sess::has('categorias.1')) active @endif" data-id="1">
		  	<img src="{{ asset('images/filtros/filtro-a.png') }}" alt="">
		  	<span>ARQUITECTURA</span>
		  </a>
		  <a href="" class="filtro_cat @if(Sess::has('categorias.2')) active @endif" data-id="2">
		  	<img src="{{ asset('images/filtros/filtro-i.png') }}" alt="">
		  	<span>INTERIORISMO</span>
		  </a>
		  <a href="" class="filtro_cat @if(Sess::has('categorias.3')) active @endif" data-id="3">
		  	<img src="{{ asset('images/filtros/filtro-s.png') }}" alt="">
		  	<span>SUSTENTABILIDAD</span>
		  </a>
          <a href="" class="filtro_cat @if(Sess::has('categorias.4')) active @endif" data-id="4">
		  	<img src="{{ asset('images/filtros/filtro-o.png') }}" alt="">
		  	<span>OAP</span>
		  </a>
          <a href="" class="filtro_cat @if(Sess::has('categorias.5')) active @endif" data-id="5">
		  	<img src="{{ asset('images/filtros/filtro-p.png') }}" alt="">
		  	<span>PAISAJISMO</span>
		  </a>
		  
		  <div class="conceptos">
		  	<div class="conceptos-inner">
            	{{ $lista_proyectos }}
		  	</div>
		  </div>		  
	  </div>
	  <!--filtros-->
	  
	  <!--main gallery-->
	   <div class="main-gal complete">
	   		<span class="complete"><a class="no_proyecto">@if($proyectos->first())1 @else 0 @endif</a> / <a class="total_proyectos">{{ $total_proyectos }}</a></span>	
            <?php 
			$pathFull		='';
			$pp_id			='';
			$pp_titulo		='';
			$pp_arquitectura='';
			$pp_locacion	='';
			$pp_tipologia	='';
			$pp_cliente		= '';
			$pp_status 		= '';
			$pp_asociado	= '';
			$pp_dimension	= '';
			$pp_descripcion	= '';
			if( $proyectos->first() ){
				$primer_proyecto 	= $proyectos->first();
				$pp_id 				= $primer_proyecto->id;
				$pp_titulo 			= $primer_proyecto->titulo;
				$pp_arquitectura 	= $primer_proyecto->arquitectura;
				$pp_locacion 		= $primer_proyecto->locacion;
				$pp_tipologia 		= $primer_proyecto->tipologia;
				$pp_cliente			= $primer_proyecto->cliente;
				$pp_status			= $primer_proyecto->status;
				$pp_asociado		= $primer_proyecto->asociado;
				$pp_dimension		= $primer_proyecto->dimension;
				$pp_descripcion		= $primer_proyecto->descripcion;
				
				if( $primer_proyecto->imagenes ){
					$pp_imagenes = $primer_proyecto->imagenes;
					$primer_imagen = $pp_imagenes->first(); 
					$pathFull = $primer_imagen->path.$primer_imagen->archivo;
				}
			}
			?>
          <div class="bg-img" id="img_proy">
		  <img class="complete" src="{{ asset($pathFull) }}" alt="{{ strtoupper($pp_titulo) }}">
		  </div>
		  <div class="titulo-main complete">
		  	<h3 class="data-titulo">{{ strtoupper($pp_titulo) }}</h3>
		  </div>
		  
	   </div>
	  <!--main gallery-->

	  <!--Detalle proyecto-->
	  <div class="proyecto-detalle complete">
	  	<div class="controles"><small class="prev data-prev" data-p_id="{{ $pp_id }}" data-ver=">">ANTERIOR <img class="prev-img" src="{{asset ('images/prev.png')}}"></small><a class="current no_proyecto">1</a> / <a class="total_proyectos">{{ $total_proyectos }}</a><small class="next data-next" data-p_id="{{ $pp_id }}" data-ver="<"><img class="next-img" src="{{asset ('images/next.png')}}"> SIGUIENTE</small></div>
	  	<div class="cont-title"><span class="data-titulo">{{ strtoupper($pp_titulo) }}</span><a class="data-arquitectura">{{ strtoupper($pp_arquitectura) }}</a></div>
	  	<small>LOCACIÓN: <span class="data-locacion">{{ strtoupper($pp_locacion) }}</span> - TIPOLOGIA: <span class="data-tipologia">{{ strtoupper($pp_tipologia) }}</span> - CLIENTE: <span class="data-cliente">{{ strtoupper($pp_cliente) }}</span></small>
	  	<a class="ver-mas" href="#">VER MÁS</a>
	  </div>
	  <!--Detalle proyecto-->

	  <div class="main-img cycle-slideshow" data-cycle-auto-height="true">
      	@if( $imagenes )
        	@foreach($imagenes as $value)
            	@if( is_file($value->path.$value->archivo) )
	    	    	<img src="{{ asset($value->path.$value->archivo) }}" alt="">
                @endif
            @endforeach
        @else
			<img src="{{ asset('images/proyectos/bg-image-1.jpg') }}" alt="">
        @endif
	  </div>		
  </div>
  
  <div class="detalle-proyecto">
		<div class="inner">  
		<!-- DETALLES SIDE BOX -->
		  <div class="side-box">
			  <ul class="proy-tags">
				 <li><a href="">ARQUITECTURA<br> <span class="data-arquitectura">{{ strtoupper($pp_arquitectura) }}</span></a></li>
				 <li><a href="">LOCACION<br> <span class="data-locacion">{{ strtoupper($pp_locacion) }}</span></a></li>
				 <li><a href="">TIPOLOGÍA<br> <span class="data-tipologia">{{ strtoupper($pp_tipologia) }}</span></a></li>
				 <li><a href="">CLIENTE<br> <span class="data-cliente">{{ strtoupper($pp_cliente) }}</span></a></li>
				 <li><a href="">STATUS<br> <span class="data-status">{{ strtoupper($pp_status) }}</span></a></li>
				 <li><a href="">ASOCIADO<br> <span class="data-asociado">{{ strtoupper($pp_asociado) }}</span></a></li>
				 <li><a href="">DIMENSIÓN<br> <span class="data-dimension">{{ strtoupper($pp_dimension) }}</span></a></li>
			  </ul>
			  
			  <span class="vista vista-project">VISTA<img src="{{ asset('images/vista.png') }}" alt="[]"></span>
			  
		  </div>
		 <!-- DETALLES SIDE BOX -->
		 <!-- DESCRIPCION CENTER BOX -->
		  <div class="center-box justify">
			  <p class="data-descripcion">{{ $pp_descripcion }}</p>
		  </div>
		  <!-- DESCRIPCION CENTER BOX -->
		  <!-- COMPARTIR SIDE BOX -->
		  <div class="side-box ">
			  <p>COMPARTIR</p>
			  
			  <ul class="compartir">
				  <li><a href="">TWITTER </a></li>
				  <li><a href="">FACEBOOK </a></li>
				  <li><a href="">GOOGLE+ </a></li>
				  <li><a href="">PINTEREST </a></li>
			  </ul>
			  
		  </div>
		   <!-- COMPARTIR SIDE BOX -->
		  
		   <!--DETALLE IMAGES-->
		   <div class="detalle-imgs">
                @if($primer_proyecto->imagenes)
                	<?php $i=0 ?>
                	@foreach($primer_proyecto->imagenes as $value)
                    	@if( $i==0 )
                        	<?php $i++; continue; ?>
                        @endif
                    	@if( is_file($value->path.$value->archivo) )
                            <div class="img-cont complete">
                                <img src="{{ asset($value->path.$value->archivo) }}" alt="">
                                @if( !empty($value->descripcion) )
                                    <p>{{ $value->descripcion }}</p>
                                @endif
                            </div>
                        @endif
                    @endforeach
                @endif		   		   
		   </div>
		   <!--DETALLE IMAGES-->
		   
		</div>  	  
  </div>
  
@show