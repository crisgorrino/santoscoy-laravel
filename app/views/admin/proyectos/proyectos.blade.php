@extends('admin.layouts.admin_master')

@section('title') Proyectos @stop
@section('header-title') <h1>Proyectos <small>Panel de control</small></h1> @stop
@section('menu-proyectos-active') active @stop
@section('proyectos-active') active @stop

@section('breadcrumb')
	<li class="active">Proyectos</li>
@stop

@section('content') 
	<div class="row">
    	@if( Session::has('msg') )
        	{{ Session::get('msg') }}
        @endif
        <div class="col-xs-12"> 
            <div class="box">
                <div class="box-header">
                	<div class="box-tools">
	                    <a class="btn btn-lg bg-olive" href="{{ url('admin/proyectos/edit') }}"><i class="fa fa-plus-square"></i>&nbsp;Agregar</a>
    	                <a class="btn btn-lg bg-maroon delete_selected"><i class="fa fa-plus-square"></i>&nbsp;Eliminar Seleccionados</a>
                    </div>
                </div><!-- /.box-header --> 
                <div class="box-body table-responsive">
                    <form action="" method="post" name="buscador" id="buscador" onsubmit="$.trim($('#search').val());">
                        <br>
                        <table class="admintable" align="center" border="0" width="50%" cellspacing="0" cellpadding="0">
                        <tbody>
                            <tr>
                                <th align="right" nowrap="nowrap">Filtros:&nbsp;</th>
                                <td colspan="6" align="left">
                                    <table border="0" width="100%">
                                        <tr>
                                            @if( $categorias )
                                            @if( Input::has('categoria_id') and Input::get('categoria_id') )
                                            <th style="background-color:#FC9; text-align:right;" align="right">
                                            @else
                                            <th style="text-align:right;" align="right">
                                            @endif
                                            <label>Categor&iacute;as: </label></th>
                                            <td>
                                            	@foreach($categorias as $value)
                                                    {{ Form::checkbox('categoria_id[]', $value->id, false, array('class'=> 'categoria_chk') ).' '.Form::label('categoria', $value->nombre) }}
                                                @endforeach
                                            </td>
                                            @endif
                                        </tr>
                                    </table>
                                    
                                </td>
                            </tr> 
                            <tr>
                                <th align="right" nowrap="nowrap">Buscar en:&nbsp;</th>
                                <td align="left">
                                <select name="campo" id="campo" class="form-control">
                                    <option value="">Cualquier Campo</option>
                                    @foreach($fields_search as $key=>$value)
                                        <?php $sel=''; ?>
                                        @if( Input::has('campo') and Input::get('campo')==$key ) )
                                            <?php $sel='selected="selected"'; ?>
                                        @endif
                                        <option {{ $sel}} value="{{ $key }}">{{ $value }}</option>
                                    @endforeach
                                </select>
                                </td>
                                        
                                <th><?php /*?>Orden&nbsp;<?php */?></th>
                                <td>
                                    <?php /*?><select id="orden" name="orden">
                                        <option value="DESC" <?php if($orden=='DESC') echo 'selected="selected"'; ?>>Descende</option>
                                        <option value="ASC" <?php if($orden=='ASC') echo 'selected="selected"'; ?>>Ascendente</option>
                                    </select><?php */?>&nbsp;
                                </td>
                                
                                <th align="left" nowrap="nowrap"><?php /*?>Palabra(s):<?php */?></th>
                                <td align="left">
                                <input type="text" name="search" id="search" value="{{ Input::get('search') }}" class="form-control" />
                                </td>
                                <td align="left">&nbsp;
                                <input type="submit" value="Buscar / Filtrar" name="enviar" id="enviar" class="btn btn-default" onclick="$('#buscador').attr('action', ''); $('#buscador').attr('target', '');" />&nbsp;
                                <input type="button" id="reset" name="reset" value="Restablecer" onclick="$('#buscador').trigger("reset"); <?php /*?>this.form.submit();<?php */?>" class="btn btn-default" />
                                </td>
                            </tr>
                        </tbody>
                        </table>
                        <p>&nbsp;</p>
                    </form>
                    @include('admin.proyectos.proyectos_ajax_list')
                </div>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    <div>
@stop

@section('scripts')
	@parent
    
    <!-- DATA TABLES -->
    <link href="{{ asset('AdminLTE/css/datatables/dataTables.bootstrap.css') }}" rel="stylesheet" type="text/css" />
    <!-- DATA TABES SCRIPT -->
    <script src="{{ asset('AdminLTE/js/plugins/datatables/jquery.dataTables.js') }}" type="text/javascript"></script>
    <script src="{{ asset('AdminLTE/js/plugins/datatables/dataTables.bootstrap.js') }}" type="text/javascript"></script>
    <script type="text/javascript">
		$(function() {
			$('#table-list').dataTable({
				"bPaginate": false,
				"bLengthChange": false,
				"bFilter": false,
				"bSort": false,
				"bInfo": false,
				"bAutoWidth": false
			});
		});
	</script>
    
    <!-- Para JAlerts -->
    <?php /*?><script src="{{ asset('js/jqueryAlerts/jquery-1.8.2.js') }}" type="text/javascript"></script><?php */?>
    <script src="{{ asset('js/jqueryAlerts/jquery.ui.draggable.js') }}" type="text/javascript"></script>
    <!-- Core files -->
    <script src="{{ asset('js/jqueryAlerts/jquery.alerts.js') }}" type="text/javascript"></script>
    <link href="{{ asset('js/jqueryAlerts/jquery.alerts.css') }}" rel="stylesheet" type="text/css" media="screen" />
    <!-- Fin JAlerts -->
    
    <?php /*?><!-- Para Table Sorter -->
    <link href="{{ asset('js/jquery.tablesorter/themes/blue/style.css') }}" rel="stylesheet" type="text/css" media="screen" />
    <script type="text/javascript" src="{{ asset('js/jquery.tablesorter/jquery-1.8.2.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/jquery.tablesorter/jquery.tablesorter.min.js') }}"></script>
    <script type="text/javascript">
    $(document).ready(function($){ 
	
		$(".avoid-sort").data("sorter", false);
		
            $(".tablesorter").tablesorter({
                headers: { 
                    // assign the secound column (we start counting zero) 
                    1: { 
                        sorter: false 
                    }, 
                    3: { 
                        sorter: false 
                    },
					4: { 
                        sorter: false 
                    },
					
                }
            }); 
        } 
    ); 
    </script>
    <!-- Fin Table Sorter --><?php */?> 
        
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
      color: '#fff', // #rgb or #rrggbb
      speed: 1, // Rounds per second
      trail: 60, // Afterglow percentage
      shadow: false, // Whether to render a shadow
      hwaccel: false, // Whether to use hardware acceleration
      className: 'spinner', // The CSS class to assign to the spinner
      zIndex: 2e9, // The z-index (defaults to 2000000000)
      top: 'auto', // Top position relative to parent in px
      left: 'auto' // Left position relative to parent in px
    };
    </script>
    <!-- Spinner -->
    
    <!-- Lightbox agregar comentarios -->
    <script type="text/javascript" src="{{ asset('js/jquery.lightbox_me.js') }}"></script>
    <!-- Lightbox agregar comentarios -->
    
    <script type="text/javascript">	
	
	$(document).ready(function(e) {
		$('.delete_selected').click(function(e){
			e.preventDefault();
			
			var total = $('input.checkbox_del:checked').length;
			
			if(total <= 0){
                jAlert('Por favor elige al menos un elemento.', 'Mensaje');
            }else{
                
                jConfirm('&iquest;Est&aacute; seguro de que desea eliminar <b>'+total+'</b> registro(s) seleccionado(s)?\n<b>Advertencia:</b> Tenga Cuidado!', 'Confirmar', function(r){
					if(r){
						$('#adminForm').attr('action', '{{ url("admin/proyectos/delete") }}'); 
						$('#adminForm').submit();
					}            
                });
            }
			
		});
		
        $('#checkall').click(function(){
			if($(this).is(':checked')) {
				$('.checkbox_del').prop('checked', true);
			}
			else{
				$('.checkbox_del').prop('checked', false);
			}
		});
		
		$('.checkbox_del').click(function(){
			
			if( $(this).not(':checked') ){
				$('#checkall').prop('checked', false);
			}
			
			if( $('.checkbox_del').length ==  $('input.checkbox_del:checked').length ){
				$('#checkall').prop('checked', true);
			}
			
			
		});
    });
	</script>
    
    <script type="text/javascript">
 	var entrar=true;
	$(window).on('hashchange', function() {
		
		if( entrar==true )
		{
			//if (window.location.hash) 
			{
				var page = window.location.hash.replace('#', '');
				//alert(page);
				if (page == Number.NaN || page <= 0) {
					entrar=true;
					return false;
				} else {
					getItems(page);
				}
			}
		}
		entrar=true;
		
	});
	 
	$(document).ready(function() {
		$(document).on('click', '.pagination a', function (e) {
			entrar=false;
			getItems($(this).attr('href').split('page=')[1]);
			e.preventDefault();
		});
				
		$('#enviar').click(function(e){
			e.preventDefault();
			getItems(1);
		});
		
		$('#reset').click(function(e){
			e.preventDefault();
			$('#search').val(''); 
			getItems(1);
		});
		
		$('#por_fecha').click(function(e){
			e.preventDefault();
			getItems(1);
		});
		
		$('#reset_por_fecha').click(function(e){
			e.preventDefault();
			$('#f_ini').val('');
			$('#f_fin').val('');
			getItems(1);
		});
		
	});
	 
	function getItems(page) {
		
		$.ajax({
			url : '?page=' + page,
			data: $('#buscador').serialize(),
			dataType: 'json',
		}).done(function (data) {
			
			$('.items').css({opacity: 1.0, visibility: "visible"}).animate({opacity: 0}, 400, function() {
				//spinner.stop();
				// Animation complete.
				$(this).html(function(){
					$(this).css({opacity: 0, visibility: "visible"}).animate({opacity: 1},400);
					return data;
				});
			});
			
			//$('.items').html(data);
			entrar=false;
			location.hash = page;
		}).fail(function () {
			jAlert('Elementos no cargados.', 'ERROR');
		});
	}
	</script>
@stop