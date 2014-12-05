
 <!--section pages-->
  <div class="section-pages-cont">
	
	@section('editorial')  
  	<div class="editorial-cont cf">
 	 	<div class="top cf"> 
 	 		<div class="inner"> 	 		
	  			<h2>EDITORIAL</h2> <img src="{{ asset('images/editorial/design-logo.png') }}" alt="SA"> <span class="vista-gray">VISTA &nbsp;&nbsp;<img src="{{ asset('images/vista.png') }}" alt="[]"></span>
 	 		</div>	
  	 	</div>
  	 	<span class="counter">14 / 27</span>
  	 	<!--SLIDER-->
  	 	<div class="slide-container">
	  	 	<div id="slider1" class="jcarousel-wrapper">	
				<a class="buttons prev jcarousel-control-prev" href="#">&#60;</a>
				<div class="viewport jcarousel">
					<ul class="overview">
						<li>1</li>
						<li>2</li>
						<li>3</li>
						<li><img src="{{ asset('images/editorial/edicion.jpg') }}" alt=""></li>
						<li>5</li>
						<li>6</li>
						<li>7</li>
						<li>8</li>
						<li>9</li>
						<li>10</li>
						<li>11</li>
						<li>12</li>
						<li>13</li>
						<li>14</li>
						<li>15</li>
						<li>16</li>
						<li>17</li>
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
	  			<h2>TALLER</h2> <img src="{{ asset('images/taller/sa.png') }}" alt="SA">
  	 		</div>
  	 	</div>
  	 	
  	 	<div id="tab-container" class="tab-container">
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
	  	 	  	 	
	  	 	<ul class='etabs'>
		  	 	<li class='tab'><a href="#preparacion">PREPARACÍON</a></li> -
		  	 	<li class='tab'><a href="#incubacion">INCUBACIÓN</a></li> -
		  	 	<li class='tab'><a href="#iluminacion">ILUMINACIÓN</a></li> -
		  	 	<li class='tab'><a href="#verificacion">VERIFICACIÓN</a></li> <!---
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
						 <li><a href="">COMPARTIR CONTACTO <img src="{{ asset('images/contacto/comp-cont.png') }}"></a></li>
						 <li><a href="">ENVIAR E-MAIL <img src="{{ asset('images/contacto/email.png') }}"></a></li>
						 <li><a href="">CONTACTANOS <img src="{{ asset('images/contacto/email.png') }}"></a></li>
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
				<a href="">TWITTER</a>

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
		 <form class="cf">
		 	
		 	<div class="inner cf">
			 	<p class="left"><label>BUSCAR</label> <input type="text" placeholder="LOBBY 33"></p> 
			 	<!--<span class="close-busq right">CERRAR X</span>-->
		 	</div>
		 	 	
		 </form>
		 
		 <div class="busqueda-resultados">
		 	
		 	<!--resultado 1-->
		 	<div class="resultado cf">
			 	<h5>
				 	<strong>LOBBY 33</strong>
				 	ARQUITECTURA<br>
				 	INTERIORISMO 2014
			 	</h5>
			 	
			 	<p><span>LOBBY 33</span> ipsum dolor sit amet, consectetur adipiscing elit. LOBBY 33 quis bibendum nulla</p>
			 	
			 	<div class="detalles">
				 	<p>locación: méxico DF</p>
				 	<p>tipología: habitacional</p>
				 	<p>cliente: fullconcept</p>
				 	<p>status: completo</p>
				 	<p>asociado: bdp</p>
				 	<p>dimensión: 1000m2-</p>  
			 	</div>
			 	<a href="#">VER MAS</a>
		 	</div>
			<!--resultado 1-->
			
			<!--resultado 1-->
		 	<div class="resultado cf">
			 	<h5>
				 	<strong>LOBBY 33</strong>
				 	ARQUITECTURA<br>
				 	INTERIORISMO 2014
			 	</h5>
			 	
			 	<p><span>LOBBY 33</span> ipsum dolor sit amet, consectetur adipiscing elit. LOBBY 33 quis bibendum nulla</p>
			 	
			 	<div class="detalles">
				 	<p>locación: méxico DF</p>
				 	<p>tipología: habitacional</p>
				 	<p>cliente: fullconcept</p>
				 	<p>status: completo</p>
				 	<p>asociado: bdp</p>
				 	<p>dimensión: 1000m2-</p>  
			 	</div>
			 	<a href="#">VER MAS</a>
		 	</div>
			<!--resultado 1-->
			
			<!--resultado 1-->
		 	<div class="resultado cf">
			 	<h5>
				 	<strong>LOBBY 33</strong>
				 	ARQUITECTURA<br>
				 	INTERIORISMO 2014
			 	</h5>
			 	
			 	<p><span>LOBBY 33</span> ipsum dolor sit amet, consectetur adipiscing elit. LOBBY 33 quis bibendum nulla</p>
			 	
			 	<div class="detalles">
				 	<p>locación: méxico DF</p>
				 	<p>tipología: habitacional</p>
				 	<p>cliente: fullconcept</p>
				 	<p>status: completo</p>
				 	<p>asociado: bdp</p>
				 	<p>dimensión: 1000m2-</p>  
			 	</div>
			 	<a href="#">VER MAS</a>
		 	</div>
			<!--resultado 1-->
			 
		 </div>
		  <img src="{{ asset('images/busqueda/figuras.png') }}" alt="" class="figuras">
	  </div>

	@show	  
	  
  </div>
  <!--section pages-->