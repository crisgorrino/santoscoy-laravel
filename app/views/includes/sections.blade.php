<!--section pages-->
<div class="section-pages-cont">
	
  @section('editorial')  
  	<div class="editorial-cont cf">
  		<div class="modal-detalle">
      		<div class="slide-container">
	  	 	<div id="slider1" class="jcarousel-wrapper">	
				<a class="buttons prev jcarousel-control-prev" href="#">&#60;</a>
				<div class="viewport jcarousel">
					<ul class="overview">
                    @if( $editorial )
						<?php $pos = 1 ?>
                        @foreach( $editorial as $value )
                            <li class="detalle-editorial" data-pos="{{ $pos }}">
                            	@if( is_file($value->path.$value->archivo) )
	                            	<img src="{{asset ($value->path.$value->archivo)}}">
                                @endif
                                <div class="detalle"><span>VER PUBLICACIÓN</span>{{ $value->descripcion}} <a href="//{{ $value->url }}" target="_blank">{{ $value->url }}</a></div></li>
                            <?php $pos++; ?>
                        @endforeach
                    @endif
					</ul>
				</div>
				<a class="buttons next jcarousel-control-next" href="#">&#62;</a>
		    </div>
  	 	</div>	
  	 	<!--SLIDER-->
	    </div>
 	 	<div class="top cf"> 
 	 		<div class="inner"> 	 		
	  			<h2>EDITORIAL</h2> <img src="{{ asset('images/editorial/design-logo.png') }}" alt="SA"> <span class="vista-gray">VISTA &nbsp;&nbsp;<img src="{{ asset('images/vista-black.png') }}" alt="[]"></span>
 	 		</div>	
  	 	</div>
  	 	<span class="counter"><span id="pos_editorial">1</span> / {{ $totalEditorial }}</span>
  	 	<!--SLIDER-->
  	 	<div class="slide-container slide-principal">
	  	 	<div id="slider1" class="jcarousel-wrapper">
				<a class="buttons prev jcarousel-control-prev" href="#">&#60;</a>
				<div class="viewport jcarousel">
					<ul class="overview">
                    @if( $editorial )
						<?php $pos = 1 ?>
                        @foreach( $editorial as $value )
                            <li class="hover-editorial" data-pos="{{ $pos }}" data-editorial='{{ json_encode($value) }}'><span class="">{{ $value->no_publicacion }}</span></li>
                            <?php $pos++; ?>
                        @endforeach
                    @endif
					</ul>
				</div>
				<a class="buttons next jcarousel-control-next" href="#">&#62;</a>
		    </div>
  	 	</div>	
  	 	<!--SLIDER-->
  	 	
  	 	<div class="edicion-desc center">
  	 	
	  	 	<p>Publicación independiente dedicada a la búsqueda, investigación y crítica de diseño. Una revista que muestra al mundo grandes proyectos de arquitectura e interiorismo mexicano, desde un punto de vista metódico, abierto y ecléctico, mediante selecciones minuciosas, estéticas innovadoras, diseños y creatividad de alto nivel que mantienen una constante interacción entre artistas y lectores.</p>
	  	 	
  	 	</div>
  	 	 	
	</div>
  @show
  
  @section('taller')
  	 <div class="taller-cont cf" >
  	 	<div class="top cf">
  	 		<div class="inner">
	  			<h2>TALLER</h2> <img class="logo-sa" src="{{ asset('images/taller/sa.png') }}" alt="SA">
  	 		</div>
  	 	</div>
  	 	<span class="counter"><span id="pos_taller">1</span> / 4</span>  	 	
  	 	<div id="tab-container" class="tab-container top" style="background: #C0C0C0;">
	  	 	<div class="taller-imgs panel-container">
	  	 			  	 		
	  	 		<div id="preparacion">
	  	 			<h4 class="cruz" style="top:75px; left:250px;">
	  	 				+
	  	 				<p>
	  	 					<span class="cruztitle">ETAPA 1<!--<br>PROFUNDIZAR--></span>
	  	 					<span>Cada obra arquitectónica es proyectada para convertirse en el hábitat de personas, por ello cada detalle nos acerca más a un conocimiento profundo de las 									necesidades y los alcances que un proyecto.</span>	
	  	 				</p>
	  	 			</h4>
	  	 			
	  	 			<h4 class="cruz" style="top:125px; left:750px;">
	  	 				+
	  	 				<p>
	  	 					<span class="cruztitle">ETAPA 2<!--<br>INCUBACI&Oacute;N--></span>
	  	 					<span>El conocimiento de las personas nos acerca a cumplir sus expectativas, hay una inmersión profunda en el contexto de la obra, 
	  	 					para situar y definir las propuestas.</span>	
	  	 				</p>
	  	 			</h4>
	  	 			
	  	 			<h4 class="cruz" style="top:200px; left:200px;">
	  	 				+
	  	 				<p>
	  	 					<span class="cruztitle">ETAPA 3<!--<br>ILUMINACI&Oacute;N--></span>
	  	 					<span>Conjugar la sustentabilidad del proyecto, su viabilidad ante el entorno, con el paisaje y el diseño de la biodiversidad que lo acompañará, así como los procesos 									específicos que el uso de la obra requiera.</span>	
	  	 				</p>
	  	 			</h4>
	  	 			
	  	 			<h4 class="cruz" style="top:270px; left:550px;">
	  	 				+
	  	 				<p>
	  	 					<span class="cruztitle">ETAPA 4<!--<br>VERIFICACI&Oacute;N--></span>
	  	 					<span>Un proyecto sustentable no sólo es amigable con el ambiente; sino que busca aprovechar y optimizar cada recurso de manera que una vez construido, 												sus consumos sean mínimos. </span>	
	  	 				</p>
	  	 			</h4>

		  	 		<img src="{{ asset('images/taller/foto-taller-1.jpg') }}" alt="">
	  	 		</div>
	  	 		
	  	 		<div id="incubacion">
	  	 			<h4 class="cruz" style="top:75px; left:250px;">
	  	 				+
	  	 				<p>
	  	 					<span class="cruztitle">ETAPA 1<!--<br>PREPARACI&Oacute;N--></span>
	  	 					<span>Para alcanzar la belleza y la perfección es necesario imaginar, inventar, replantear, desechar, y evaluar ideas que al contacto con la realidad se inserten en un 								panorama previo; conceptualizando el proyecto y haciéndolo rentable.</span>	
	  	 				</p>
	  	 			</h4>
	  	 			
	  	 			<h4 class="cruz" style="top:125px; left:750px;">
	  	 				+
	  	 				<p>
	  	 					<span class="cruztitle">ETAPA 2<!--<br>INCUBACI&Oacute;N--></span>
	  	 					<span>El diseño arquitectónico son trazos que evidencian una ejecución que vaya de acuerdo a los objetivos, a los planes previos, a los tiempos programados, y que son 									llevados a lienzos en blanco que les permiten crecer.</span>	
	  	 				</p>
	  	 			</h4>
	  	 			
	  	 			<h4 class="cruz" style="top:200px; left:200px;">
	  	 				+
	  	 				<p>
	  	 					<span class="cruztitle">ETAPA 3<!--<br>ILUMINACI&Oacute;N--></span>
	  	 					<span>El proyecto toma una forma clave, que conecta al creador con las personas, siendo visualmente claro, para que éstas crean y se vean reflejadas en él.</span>	
	  	 				</p>
	  	 			</h4>
	  	 			
	  	 			<h4 class="cruz" style="top:270px; left:550px;">
	  	 				+
	  	 				<p>
	  	 					<span class="cruztitle">ETAPA 4<!--<br>VERIFICACI&Oacute;N--></span>
	  	 					<span>La arquitectura subraya así, esta conexión entre la idea y las líneas, entre la quimera y lo real. Y debe ser consciente de que lo que inició como bosquejo, vivirá 								y afectará la mancha urbana de una ciudad.</span>	
	  	 				</p>
	  	 			</h4>

		  	 		<img src="{{ asset('images/taller/foto-taller-2.jpg') }}" alt="">
	  	 		</div>
	  	 		
	  	 		<div id="iluminacion">
	  	 			<h4 class="cruz" style="top:75px; left:250px;">
	  	 				+
	  	 				<p>
	  	 					<span class="cruztitle">ETAPA 1<!--<br>PREPARACI&Oacute;N--></span>
	  	 					<span>No todos los procesos son ejecutados por una sola persona; los equipos son eso, unión de liderazgos con un fin común que requiere talento de artistas de la forma y de la técnica.</span>	
	  	 				</p>
	  	 			</h4>
	  	 			
	  	 			<h4 class="cruz" style="top:125px; left:750px;">
	  	 				+
	  	 				<p>
	  	 					<span class="cruztitle">ETAPA 2<!--<br>INCUBACI&Oacute;N--></span>
	  	 					<span>Por un momento ambas obras se cruzan para fusionar estética y posibilidad; piezas que van encajando de a poco para dar continuidad a la integración final del proyecto.</span>	
	  	 				</p>
	  	 			</h4>
	  	 			
	  	 			<h4 class="cruz" style="top:200px; left:200px;">
	  	 				+
	  	 				<p>
	  	 					<span class="cruztitle">ETAPA 3<!--<br>ILUMINACI&Oacute;N--></span>
	  	 					<span>El diseño de interiores y exteriores dará una forma sólida a las ideas previas, a su correcto acomodo en el rompecabezas arquitectónico y a su función final y sus beneficios.</span>	
	  	 				</p>
	  	 			</h4>
	  	 			
	  	 			<h4 class="cruz" style="top:270px; left:550px;">
	  	 				+
	  	 				<p>
	  	 					<span class="cruztitle">ETAPA 4<!--<br>VERIFICACI&Oacute;N--></span>
	  	 					<span>Combinación de texturas, formas, colores que definen el destino absoluto de una creación que cumpla con expectativas e incluso las supere, para lograr un espacio incomparable.</span>	
	  	 				</p>
	  	 			</h4>

		  	 		<img src="{{ asset('images/taller/foto-taller-1.jpg') }}" alt="">
	  	 		</div>
	  	 		
	  	 		<div id="verificacion">
	  	 			<h4 class="cruz" style="top:75px; left:250px;">
	  	 				+
	  	 				<p>
	  	 					<span class="cruztitle">ETAPA 1<!--<br>PREPARACI&Oacute;N--></span>
	  	 					<span>La puntualización de los detalles  se traducen ya, en un punto de partida para comenzar la labor más ardua, que es el dar vida al diseño y la optimización de costos para el constructor.</span>	
	  	 				</p>
	  	 			</h4>
	  	 			
	  	 			<h4 class="cruz" style="top:125px; left:750px;">
	  	 				+
	  	 				<p>
	  	 					<span class="cruztitle">ETAPA 2<!--<br>INCUBACI&Oacute;N--></span>
	  	 					<span>La estafeta artística y técnica que generó la imaginería y el papel, pasa ahora a las manos de especialistas en el modelado de la estructura y la realidad. La obra comienza a ser.</span>	
	  	 				</p>
	  	 			</h4>
	  	 			
	  	 			<h4 class="cruz" style="top:200px; left:200px;">
	  	 				+
	  	 				<p>
	  	 					<span class="cruztitle">ETAPA 3<!--<br>ILUMINACI&Oacute;N--></span>
	  	 					<span>La materialización y el cuidado de una obra se conciben bajo premisas específicas, mismas que deben continuar inamovibles por su filosofía y las revisiones previas de factibilidad y gestión.</span>	
	  	 				</p>
	  	 			</h4>
	  	 			
	  	 			<h4 class="cruz" style="top:270px; left:550px;">
	  	 				+
	  	 				<p>
	  	 					<span class="cruztitle">ETAPA 4<!--<br>VERIFICACI&Oacute;N--></span>
	  	 					<span>La creación de un sitio ideal para las personas es minucioso, la arquitectura da cobijo a contextos de vida y forma estructuras que las contienen. Es el arte de habitar y crear espacios funcionales y hacerlos públicos, para todos.</span>	
	  	 				</p>
	  	 			</h4>

		  	 		<img src="{{ asset('images/taller/foto-taller-3.jpg') }}" alt="">
	  	 		</div>
	  	 			  	 		
	  	 	</div>
	  	 	  	 	
	  	 	<ul class='etabs' style="background-color: #CCC;">
		  	 	<li class='tab'><a class="item-taller" data-pos="1" href="#preparacion">PROFUNDIZAR</a></li> -
		  	 	<li class='tab'><a class="item-taller" data-pos="2" href="#incubacion">TRAZAR</a></li> -
		  	 	<li class='tab'><a class="item-taller" data-pos="3" href="#iluminacion">DEFINIR</a></li> -
		  	 	<li class='tab'><a class="item-taller" data-pos="4" href="#verificacion">CREAR</a></li> <!---
		  	 	<li class='tab'><a href="#preparacion">PREPARACÍON</a></li> -
		  	 	<li class='tab'><a href="#incubacion">INCUBACIÓN</a></li>-->
	  	 	</ul>  	 	
	    </div>
  	 </div>
  @show
	  
  @section('contacto')
  <div class="contact-cont cf">
    
    <div class="inner cf">
        <h2 class="left">Contacto</h2> <!--<span class="close right">CERRAR X</span>-->
    </div>  	
         <nav>
            <div class="inner cf">
                 <ul>
                     <li><a href="mailto:carlossantoscoy@santoscoyarquitectos.com?subject={{ rawurlencode('COMPARTIR CONTACTO SANTOSCOY') }}&body={{ rawurlencode('SANTOSCOY ARQUITECTOS
                     
	T. +33.3627.5594 / 95
	carlossantoscoy@santoscoyarquitectos.com
	www.santoscoyarquitectos.com
	AV. PARAISOS 170
	CIUDAD GRANJA
	ZAP., JAL., MX. CP 45010') }}">COMPARTIR CONTACTO <img src="{{ asset('images/contacto/comp-cont.png') }}"></a></li>
                     <li><a href="mailto:carlossantoscoy@santoscoyarquitectos.com?subject={{ rawurlencode('CONTACTO CARLOS SANTOSCOY') }}">ENVIAR E-MAIL <img src="{{ asset('images/contacto/email.png') }}"></a></li>
                     <li><a>SÍGUENOS <img src="{{ asset('images/contacto/siguenos.png') }}"></a></li>
                 </ul>
            </div>	 
         </nav> 

    
     <div class="contact-inner">
        <!--info contacto-->
         <div class="contact-info">
             <p>SANTOSCOY ARQUITECTOS</p>
             <p>T. +33.3627.5594 / 95</p>
             <p>carlossantoscoy@santoscoyarquitectos.com</p>
             <p>www.santoscoyarquitectos.com</p>
             <p>Av. paraisos 170</p>
             <p>ciudad granja</p>
             <p>zap., jal., mx. cp 45010</p>
         </div>
         <!--info contacto-->
         
         <!-- Carlos Santoscoy-->
         <div class="carlossantoscoy">
             <h4>CARLOS SANTOSCOY</h4>
         </div>
         <!-- Carlos Santoscoy-->
         
         <!--REDES-->
         <div class="redes">
            <a href="">INSTAGRAM</a>
            <a href="">FACEBOOK</a>
            <a href="">GOOGLE+</a>
            <a href="">PINTEREST</a>
         </div>
         <!--REDES-->
     </div>
  </div>
  @show
  
  @section('busqueda')
  <div class="busqueda-cont cf">
     <form class="cf" id="frm_search" name="frm_search" method="post">
        
        <div class="inner cf">
            <p class="left"><label>BUSCAR</label> <input type="text" id="search" name="search" placeholder="LOBBY 33"></p> 
            <span class="close-busq right">CERRAR <img src="{{ asset('images/close.png') }}" alt="[]"></span>
        </div>
            
     </form>
     
     <div class="busqueda-resultados"></div>
      <img src="{{ asset('images/busqueda/figuras.png') }}" alt="" class="figuras">
  </div>
  @show	  
	  
</div>
<!--section pages-->