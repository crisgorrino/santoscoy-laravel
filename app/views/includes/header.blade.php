@section('header')
 <!--header-->
  	<header>
	  	<nav>
		  	<ul>
			  	<li><a href="">PROYECTOS</a></li>
			  	<li><a href="" class="taller">TALLER</a></li>
			  	<li><a href="" class="editorial">EDITORIAL</a></li>
			  	<li><a href="" class="contacto">CONTACTO</a></li>
			  	<li><a href="" class="busqueda">BUSQUEDA</a></li>
		  	</ul>
		  	<div class="logo-cont cf">
		  		<div class="inner">
			  		<a href="{{ url() }}"><img src="{{ asset('images/header/logo.png') }}" alt=""></a>
			  		<span class="vista right">VISTA &nbsp;&nbsp;<img src="{{ asset('images/vista.png') }}" alt="[]"></span>
		  		</div>	
		  	</div>
	  	</nav>	  	
  	</header>
  <!--header-->

@show