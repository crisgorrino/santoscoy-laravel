@extends('admin.layouts.admin_master')

@section('title') Productos @stop
@section('header-title') <h1>Productos <small>@if( $categoria )Editar @else Agregar @endif</small></h1> @stop
@section('menu-productos-active') active @stop
@section('categorias-active') active @stop

@section('breadcrumb')
	<li><a href="{{ url('admin/productos') }}">Productos</a></li>
	<li class="active">Categor&iacute;as</li>
@stop

@section('content') 
	<div class="row">
    		<?php /*?><div class="alert alert-danger alert-dismissable">
                <i class="fa fa-ban"></i>
                <a type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</a>
                <b>Alert!</b> Danger alert preview. This alert is dismissable. A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart.
            </div>
            <div class="alert alert-info alert-dismissable">
                <i class="fa fa-info"></i>
                <a type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</a>
                <b>Alert!</b> Info alert preview. This alert is dismissable.
            </div>
            <div class="alert alert-warning alert-dismissable">
                <i class="fa fa-warning"></i>
                <a type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</a>
                <b>Alert!</b> Warning alert preview. This alert is dismissable.
            </div>
            <div class="alert alert-success alert-dismissable">
                <i class="fa fa-check"></i>
                <a type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</a>
                <b>Alert!</b> Success alert preview. This alert is dismissable.
            </div><?php */?>
        @if ( $errors->count() > 0 )
        	<div class="desvanecer alert alert-danger alert-dismissable">
                <i class="fa fa-ban"></i>
                <a type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</a>
                <p>Errores encontrados : 
                	<ul>
                        @foreach( $errors->all() as $key =>$value )
                          <li>{{ $value }}</li>
                        @endforeach
                    </ul>
                </p>
            </div>
        @endif
        
    	@if( Session::has('msg') )
	        {{ Session::get('msg') }}            
	    @endif
        @include('admin.producto_categorias.categorias_edit_datos')
        </div>
    <div>
@stop

@section('scripts')
	@parent
    
    <!-- Para JAlerts -->
    <?php /*?><script src="{{ asset('js/jqueryAlerts/jquery-1.8.2.js') }}" type="text/javascript"></script><?php */?>
    <script src="{{ asset('js/jqueryAlerts/jquery.ui.draggable.js') }}" type="text/javascript"></script>
    <!-- Core files -->
    <script src="{{ asset('js/jqueryAlerts/jquery.alerts.js') }}" type="text/javascript"></script>
    <link href="{{ asset('js/jqueryAlerts/jquery.alerts.css') }}" rel="stylesheet" type="text/css" media="screen" />
    <!-- Fin JAlerts -->
    
    <!--jQuery Validation Engine -->
    <link rel="stylesheet" href="{{ asset('js/jQuery-Validation-Engine/css/validationEngine.jquery.css') }}" type="text/css"/>
    <?php /*?><script src="{{ asset('js/jQuery-Validation-Engine/js/jquery-1.8.2.min.js') }}" type="text/javascript"></script><?php */?>
    <script src="{{ asset('js/jQuery-Validation-Engine/js/languages/jquery.validationEngine-es.js') }}" type="text/javascript" charset="utf-8"></script>
    <script src="{{ asset('js/jQuery-Validation-Engine/js/jquery.validationEngine.js') }}" type="text/javascript" charset="utf-8"></script>
    <script type="text/javascript">
		$(document).ready(function(e) {
            $("#frm_edit").validationEngine({ 
				autoPositionUpdate:true,
                focusFirstField : true ,
                validateNonVisibleFields:false,
                updatePromptsPosition: true,
                scroll:false,
                autoHidePrompt: true,
                autoHideDelay: 5000,
                fadeDuration: 400
			});
        });
	</script>
    <!--jQuery Validation Engine -->
            
    <!-- Spinner -->
    <script src="{{ asset('js/spin.min.js') }}"></script>
    <script type="text/javascript" language="javascript">
    var optsSpin = {
      lines: 13, // The number of lines to draw
      length: 4, // The length of each line
      width: 3, // The line thickness
      radius: 7, // The radius of the inner circle
      corners: 1, // Corner roundness (0..1)
      rotate: 0, // The rotation offset
      direction: 1, // 1: clockwise, -1: counterclockwise
      color: '#000', // #rgb or #rrggbb
      speed: 1, // Rounds per second
      trail: 60, // Afterglow percentage
      shadow: false, // Whether to render a shadow
      hwaccel: false, // Whether to use hardware acceleration
      className: 'spinner', // The CSS class to assign to the spinner
      zIndex: 2e9, // The z-index (defaults to 2000000000)
      top: '80px', // Top position relative to parent in px
      left: '50%' // Left position relative to parent in px
    };
    </script>
    <!-- Spinner -->
    
    <script type="text/javascript">
	$(document).ready(function() {
        $('.save').click(function(e){
			e.preventDefault();
			
			if( $("#frm_edit").validationEngine('validate') )
			{
				$('#frm_edit').submit();
			}
			
		});
    });
	</script>
@stop