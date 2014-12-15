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
	   		<span class="complete"><a id="no_proyecto">1</a> / <a id="total_proyectos">{{ $total_proyectos }}</a></span>	
            <?php 
			$primer_proyecto = $proyectos->first();
			$imagenes = $primer_proyecto->imagenes;
			$primer_imagen = $imagenes->first(); ?>
          <div id="img_proy">
		  <img class="complete" src="{{ asset($primer_imagen->path.$primer_imagen->archivo) }}" alt="{{ strtoupper($primer_proyecto->titulo) }}">
		  </div>
		  <div class="titulo-main complete">
		  	<h3>{{ strtoupper($primer_proyecto->titulo) }}</h3>
		  </div>
		  
	   </div>
	  <!--main gallery-->

	  <!--Detalle proyecto-->
	  <div class="proyecto-detalle complete">
	  	<div class="controles"><small class="prev">ANTERIOR <img class="prev-img" src="{{asset ('images/prev.png')}}"></small><a class="current" id="no_proyecto">1</a> / <a id="total_proyectos">{{ $total_proyectos }}</a><small class="next"><img class="next-img" src="{{asset ('images/next.png')}}"> SIGUIENTE</small></div>
	  	<span class="titulo">LOBBY<br>ARQUITECTURA INTERIORISMO 2014</span>
	  	<small>LOCACIÓN: MÉXICO DF - TIPOLOGIA: HABITACIONAL - CLIENTE: FULLCONCEPT</small>
	  	<a class="ver-mas" href="#">VER MÁS</a>
	  </div>
	  <!--Detalle proyecto-->

	  <div class="main-img cycle-slideshow">
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
				 <li><a href="">ARQUITECTURA<br> <span id="arquitectura">{{ strtoupper($primer_proyecto->arquitectura) }}</span></a></li>
				 <li><a href="">LOCACION<br> <span id="locacion">{{ strtoupper($primer_proyecto->locacion) }}</span></a></li>
				 <li><a href="">TIPOLOGÍA<br> <span id="tipologia">{{ strtoupper($primer_proyecto->tipologia) }}</span></a></li>
				 <li><a href="">CLIENTE<br> <span id="cliente">{{ strtoupper($primer_proyecto->cliente) }}</span></a></li>
				 <li><a href="">STATUS<br> <span id="status">{{ strtoupper($primer_proyecto->status) }}</span></a></li>
				 <li><a href="">ASOCIADO<br> <span id="asociado">{{ strtoupper($primer_proyecto->asociado) }}</span></a></li>
				 <li><a href="">DIMENSIÓN<br> <span id="dimension">{{ strtoupper($primer_proyecto->dimension) }}</span></a></li>
			  </ul>
			  
			  <span class="vista vista-project">VISTA &nbsp;&nbsp;<img src="{{ asset('images/vista.png') }}" alt="[]"></span>
			  
		  </div>
		 <!-- DETALLES SIDE BOX -->
		 <!-- DESCRIPCION CENTER BOX -->
		  <div class="center-box justify" id="descripcion">
			  <p>{{ $primer_proyecto->descripcion }}</p>
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
                @if($imagenes->count() > 1)
                	<?php $i=0 ?>
                	@foreach($imagenes as $value)
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