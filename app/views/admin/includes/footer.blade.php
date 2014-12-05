@section('footer')
<footer class="cf">
	<section class="inner">
		<a class="logo-footer" href="{{url('')}}"><img src="{{asset('img/logo-footer.png')}}"></a></ul><ul class="social-bar">
				<li><a target="_blank" class="icon-instagram" href="http://instagram.com/dicantarero"></a></li>
				<li><a target="_blank" class="icon-pinterest" href="http://www.pinterest.com/dicantarero/"></a></li>
				<li><a target="_blank" class="icon-twitter" href="http://twitter.com/dicantarero"></a></li>
				<li><a target="_blank" class="icon-facebook" href="http://www.facebook.com/lacCLOTHING"></a></li>
				<li><a class="btn_red" href="{{url('comprobante')}}">CARGA DE COMPROBANTE</a></li>
			</ul><ul class="menu-footer cf">
			<li><a href="#">HOMBRE</a>
			<ul class="submenu-footer">
            	@if( $catH->count() > 0 )
                	@foreach($catH as $c)
                    	<li><a class="@yield('current-hombre'.strtolower($c->nombre))" href="{{ url('tienda/'.$c->tipo.'/'.strtolower($c->nombre)) }}">{{ $c->nombre }}</a></li>
                    @endforeach
                @endif
			</ul>
			</li><li><a href="#">MUJER</a>
			<ul class="submenu-footer">
            	@if( $catM->count() > 0 )
                	@foreach($catM as $c)
                    	<li><a class="@yield('current-mujer'.strtolower($c->nombre))" href="{{ url('tienda/'.$c->tipo.'/'.strtolower($c->nombre)) }}">{{ $c->nombre }}</a></li>
                    @endforeach
                @endif
			</ul>
			</li><li><a href="puntos-venta" class="@yield('current-puntos-venta')">PUNTOS DE VENTA</a>
			<ul class="submenu-footer-bold">
				<li><a href="{{url('contacto')}}" class="@yield('current-contacto')">ATENCIÓN AL CLIENTES</a></li>
				<li><a href="{{url('politicas-envio')}}" class="@yield('current-politicas-envio')">ENVIÓS</a></li>
				<li><a href="{{url('FAQS')}}" class="@yield('current-faqs')">FAQ'S</a></li>
				<li><a href="{{url('beneficios-compra')}}" class="@yield('current-beneficios-compra')">BENEFICIOS</a></li>
				<li><a href="{{url('cambios-devoluciones')}}" class="@yield('current-cambios-devoluciones')">CAMBIOS Y DEVOLUCIONES</a></li>
			</ul>
			</li>
		</ul><ul class="social-bar">
			<li><a target="_blank" class="icon-instagram" href="http://instagram.com/dicantarero"></a></li>
			<li><a target="_blank" class="icon-pinterest" href="http://www.pinterest.com/dicantarero/"></a></li>
			<li><a target="_blank" class="icon-twitter" href="http://twitter.com/dicantarero"></a></li>
			<li><a target="_blank" class="icon-facebook" href="http://www.facebook.com/lacCLOTHING"></a></li>
			<li><a class="btn_red" href="{{url('carga-comprobante')}}">CARGA DE COMPROBANTE</a></li>
		</ul>
	</section>
</footer>
@show