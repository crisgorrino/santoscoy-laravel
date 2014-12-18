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
	  	 	<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam quis bibendum nulla. Nullam tincidunt vulputate bibendum. Phasellus convallis, velit vitae fringilla facilisis, nunc elit vulputate ante, non dictum sem massa at neque. Maecenas feugiat mollis arcu, lacinia dapibus diam fringilla ut. Ut nec euismod dolor. Vestibulum pellentesque urna eu cursus dapibus. Vestibulum quis viverra tellus.</p>

<p>Nullam tincidunt mi dolor, ultrices hendrerit metus egestas nec. Nullam iaculis sed tellus eget pretium. Mauris tempus a magna at laoreet. Fusce sagittis risus ut quam eleifend feugiat. Maecenas vitae risus in enim feugiat semper id quis lectus. Curabitur nec ante consequat, ultrices nunc.</p>

<p>interdum diam. Etiam sollicitudin feugiat risus quis vehicula. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.</p>

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
	  	 		
	  	 			<h4 class="cruz" style="top:75px; left:250px;">
	  	 				+
	  	 				<p>
	  	 					<span class="cruztitle">ETAPA 1<br>PREPARACI&Oacute;N</span>
	  	 					<span>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam quis bibendum nulla. Nullam tincidunt vulputate bibendum.</span>	
	  	 				</p>
	  	 			</h4>
	  	 			
	  	 			<h4 class="cruz" style="top:125px; left:750px;">
	  	 				+
	  	 				<p>
	  	 					<span class="cruztitle">ETAPA 2<br>INCUBACI&Oacute;N</span>
	  	 					<span>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam quis bibendum nulla. Nullam tincidunt vulputate bibendum.</span>	
	  	 				</p>
	  	 			</h4>
	  	 			
	  	 			<h4 class="cruz" style="top:200px; left:200px;">
	  	 				+
	  	 				<p>
	  	 					<span class="cruztitle">ETAPA 3<br>ILUMINACI&Oacute;N</span>
	  	 					<span>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam quis bibendum nulla. Nullam tincidunt vulputate bibendum.</span>	
	  	 				</p>
	  	 			</h4>
	  	 			
	  	 			<h4 class="cruz" style="top:270px; left:550px;">
	  	 				+
	  	 				<p>
	  	 					<span class="cruztitle">ETAPA 4<br>VERIFICACI&Oacute;N</span>
	  	 					<span>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam quis bibendum nulla. Nullam tincidunt vulputate bibendum.</span>	
	  	 				</p>
	  	 			</h4>
	  	 		
	  	 		<div id="preparacion">
		  	 		<img src="{{ asset('images/taller/foto-taller-1.jpg') }}" alt="">
	  	 		</div>
	  	 		
	  	 		<div id="incubacion">
		  	 		<img src="{{ asset('images/taller/foto-taller-2.jpg') }}" alt="">
	  	 		</div>
	  	 		
	  	 		<div id="iluminacion">
		  	 		<img src="{{ asset('images/taller/foto-taller-1.jpg') }}" alt="">
	  	 		</div>
	  	 		
	  	 		<div id="verificacion">
		  	 		<img src="{{ asset('images/taller/foto-taller-3.jpg') }}" alt="">
	  	 		</div>
	  	 		
	  	 		<!--<div id="preparacion">
		  	 		<img src="{{ asset('images/taller/foto-taller-1.jpg') }}" alt="">
	  	 		</div>
	  	 		
	  	 		<div id="incubacion">
		  	 		<img src="{{ asset('images/taller/foto-taller-2.jpg') }}" alt="">
	  	 		</div>-->	
	  	 		
	  	 		
	  	 	</div>
	  	 	  	 	
	  	 	<ul class='etabs' style="background-color: #CCC;">
		  	 	<li class='tab'><a class="item-taller" data-pos="1" href="#preparacion">PREPARACÍON</a></li> -
		  	 	<li class='tab'><a class="item-taller" data-pos="2" href="#incubacion">INCUBACIÓN</a></li> -
		  	 	<li class='tab'><a class="item-taller" data-pos="3" href="#iluminacion">ILUMINACIÓN</a></li> -
		  	 	<li class='tab'><a class="item-taller" data-pos="4" href="#verificacion">VERIFICACIÓN</a></li> <!---
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