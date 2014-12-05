<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function showWelcome()
	{
		return View::make('hello');
	}
	
	public function getIndex(){
		
		$proyectos = Proyectos::with('imagenes', 'categorias')
							  ->orderBy('id', 'DESC')
							  ->get();
		
		$lista_proyectos = ''; 
        if( $proyectos){
        	foreach($proyectos as $value){
            	$lista_proyectos.='<a href="" class="ver_detalle" data-p_id="'.$value->id.'">'.$value->titulo.'</a> - ';
			}
		}
		
		if( !empty($lista_proyectos) ){
			$lista_proyectos = strtoupper(substr($lista_proyectos, 0, -3));
		}
		
		//echo "<pre>";
		//dd( print_r( get_class_methods($proyectos) ) );
		
		
		return View::make('pages.index',
			array(
				'proyectos'			=> $proyectos,
				'lista_proyectos'	=> $lista_proyectos,
			)
		);
	}

}
