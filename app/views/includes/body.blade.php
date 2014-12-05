@section('body')
<div class="main">
	  
	  <!--filtros-->
	  <div class="filtros">
		  <a href="" class="active">
		  	<img src="{{ asset('images/filtros/filtro-a.png') }}" alt="">
		  	<span>ARQUITECTURA</span>
		  </a>
		  <a href="">
		  	<img src="{{ asset('images/filtros/filtro-i.png') }}" alt="">
		  	<span>INTERIORISMO</span>
		  </a>
		  <a href="">
		  	<img src="{{ asset('images/filtros/filtro-s.png') }}" alt="">
		  	<span>SUSTENTABILIDAD</span>
		  </a>
		  
		  <div class="conceptos">
		  	<div class="conceptos-inner">
            	{{ $lista_proyectos }}
		  	</div>
		  </div>		  
	  </div>
	  <!--filtros-->
	  
	  <!--main gallery-->
	   <div class="main-gal">
	   		<span><a id="no_proyecto">1</a> / {{ $proyectos->count() }}</span>	
            <?php $primer_imagen = $proyectos->first()->imagenes->first(); ?>
		  <img src="{{ asset($primer_imagen->path.$primer_imagen->archivo) }}" alt="HAIGH PARK QUERETARO">
		  
		  <div class="titulo-main">
		  	<h3>HAIGH PARK QUERETARO</h3>
		  </div>
		  
	   </div>
	  <!--main gallery-->
	  
	  <div class="main-img">
	  	<img src="{{ asset('images/proyectos/bg-image-1.jpg') }}" alt="">
	  </div>		
  </div>
  
  <div class="detalle-proyecto">
		<div class="inner">  
		<!-- DETALLES SIDE BOX -->
		  <div class="side-box">
			  <ul class="proy-tags">
				 <li><a href="">ARQUITECTURA</br> INTERIORISMO 2014</a></li>
				 <li><a href="">LOCACION</br> MÉXICO DF</a></li>
				 <li><a href="">TIPOLOGÍA</br> HABITACIONAL</a></li>
				 <li><a href="">CLIENTE</br> FULLCONCEPT</a></li>
				 <li><a href="">STATUS</br> COMPLETO</a></li>
				 <li><a href="">ASOCIADO</br> BDP.</a></li>
				 <li><a href="">DIMENSIÓN</br> 1000 M2</a></li>
			  </ul>
			  
			  <span class="vista">VISTA &nbsp;&nbsp;<img src="{{ asset('images/vista.png') }}" alt="[]"></span>
			  
		  </div>
		 <!-- DETALLES SIDE BOX -->
		 <!-- DESCRIPCION CENTER BOX -->
		  <div class="center-box justify">
			  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam quis bibendum nulla. Nullam tincidunt vulputate bibendum. Phasellus convallis, velit vitae fringilla facilisis, nunc elit vulputate ante, non dictum sem massa at neque. Maecenas feugiat mollis arcu, lacinia dapibus diam fringilla ut. Ut nec euismod dolor. Vestibulum pellentesque urna eu cursus dapibus. Vestibulum quis viverra tellus.</p>
	
			  <p>Nullam tincidunt mi dolor, ultrices hendrerit metus egestas nec. Nullam iaculis sed tellus eget pretium. Mauris tempus a magna at laoreet. Fusce sagittis risus ut quam eleifend feugiat. Maecenas vitae risus in enim feugiat semper id quis lectus. Curabitur nec ante consequat, ultrices nunc id, interdum diam. Etiam sollicitudin feugiat risus quis vehicula. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Donec gravida porta gravida. Nullam in mauris ac lorem laoreet tristique eu semper nibh. Sed eget risus urna.</p>
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
		   
		   		<div class="img-cont">
					<img src="{{ asset('images/proyectos/detalle-1.png') }}" alt="">
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam quis bibendum nulla.</p>
		   		</div>
		   		
		   		<div class="img-cont">
					<img src="{{ asset('images/proyectos/detalle-2.jpg') }}" alt="">
		   		</div>	
		   		   
		   </div>
		   <!--DETALLE IMAGES-->
		   
		</div>  	  
  </div>
  
  @show