@if( $proyectos->count() )
	@foreach($proyectos as $value)
    <!--resultados -->
        <div class="resultado cf">
            <h5>
                <strong>{{ $value->titulo }}</strong>
                ARQUITECTURA<br>
                {{ $value->arquitectura }}
            </h5>
            
            <p>{{ wordwrap($value->descripcion, 100) }}<?php /*?><span>LOBBY 33</span> ipsum dolor sit amet, consectetur adipiscing elit. LOBBY 33 quis bibendum nulla<?php */?></p>
            
            <div class="detalles">
                <p>locación: {{ $value->locacion }}</p>
                <p>tipología: {{ $value->tipologia }}</p>
                <p>cliente: {{ $value->cliente }}</p>
                <p>status: {{ $value->status }}</p>
                <p>asociado: {{ $value->asociado }}</p>
                <p>dimensión: {{ $value->dimension }}</p>  
            </div>
            <a href="" class="ver_detalle" data-pos="" data-p_id="{{ $value->id }}">VER MÁS</a>
        </div>
    <!--resultados -->
    @endforeach
@else
	<div class="resultado cf">
        <h5>¡No se encontraron Resultados!</h5>
    </div>
@endif