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
	
	/**
	* Vista principal
	*
	*/
	public function getIndex()
	{
		
		$proyectos = Proyectos::select('proyectos.*')
							  ->with('imagenes', 'categorias')
							  ->orderBy('id', 'DESC');
					
		if( Sess::has('categorias') ){
			
			$sess_cat = Sess::get('categorias');
			if( count($sess_cat) > 0 ){
				
				$proyectos = $proyectos->leftJoin('categoria_proyecto', 'proyectos.id', '=', 'categoria_proyecto.proyecto_id')
						  ->where(function($query)use($sess_cat){
							  
							  if( count($sess_cat) > 0 ){
								foreach($sess_cat as $key => $value){
									$query->orWhere('categoria_id', '=', $key);
								}
							  }
						  });
			}
			
			
		}
		else{
			$proyectos->with('categorias');
		}
							  
		$proyectos = $proyectos->get();
		
		$lista_proyectos = ''; 
        if( $proyectos){
			$i = 0;
			if( Request::ajax() ) $i=1;
			$cont = 1;
        	foreach($proyectos as $value){
				$class = '';
				if( $i == 0 ){
					$class = 'active';
					$i++;
				}
				
            	$lista_proyectos.='<a href="" data-pos="'.$cont.'" class="ver_detalle '.$class.'" data-p_id="'.$value->id.'">'.strtoupper($value->titulo).'</a> - ';
				$cont++;
			}
		}
		
		if( !empty($lista_proyectos) ){
			$lista_proyectos = substr($lista_proyectos, 0, -3);
		}
		
		$total_proyectos = $proyectos->count();
		
		if( Request::ajax() ){
			return array(
				'view' 				=> $lista_proyectos,
				'total_proyectos'	=> $total_proyectos,
			);
		}
		
		//Total de Registros
		/*$editorial = Editorial::publishedNotRemoved()
							  ->select( DB::raw("COUNT(*) AS total") )->first();
		$totalEditorial = $editorial->total;*/
		
		$limit=10;
		$pagesProx = 4;
		
		$path="'".$this->pathUpload."editorial/id_',id,'/'";
		$editorial = Editorial::publishedNotRemoved()
							  ->select('*', DB::raw("CONCAT(".$path.") AS path") )
							  ->orderBy('no_publicacion', 'DESC')
							  //->paginate( $limit )
							  //->useCurrentRoute()
							  //->canShowFirstPage()
							  //->canShowLastPage()
							  //->pagesProximity( $pagesProx )
							  ->get();
							  
		$totalEditorial = $editorial->count();
		
		$path ="'".$this->pathUpload."proyectos/id_',proyecto_id,'/img_id_', id,'/'";
		$imagenes =ProyectoImagenes::select('id', 'archivo', DB::raw("CONCAT(".$path.") AS path") )
									 ->get()
									 //->random($this->count())
									 ;
									 
		//$imagenes->random($imagenes->count());
		
		//echo "<pre>";
		//dd( print_r( get_class_methods($imagenes->random()->all()) ) );
		//dd( print_r($imagenes ) );
		
		return View::make('pages.index',
			array(
				'proyectos'			=> $proyectos,
				'lista_proyectos'	=> $lista_proyectos,
				'total_proyectos'	=> $total_proyectos,
				'editorial'			=> $editorial,
				'totalEditorial'	=> $totalEditorial,
				'imagenes'			=> $imagenes,
			)
		);
	}
	
	/**
	* Obtener los detalles de un proyecto
	*
	*/
	public function postAjax_proyecto_detalles()
	{
		if( Request::ajax() ){
			
			$id = Input::get('p_id', 0);
			$ver = Input::get('ver', '');//puede ser mayor o menor que ">" o "<"
			
			$proyecto = Proyectos::with('imagenes');
			
			if( empty($ver) ){
				$proyecto->where('id', '=', $id);
			}
			else{
				$order = 'desc';
				if( $ver == '>' ){
					$order = 'asc';
				}
				else{
					$order = 'desc';
				}
				$proyecto->where('id', $ver, $id)->orderBy('id', $order);
			}
			
			$proyecto = $proyecto->first();
			
			if( $proyecto ){
				return Response::json(
					array(
						'success'	=> true,
						'proyecto'		=> $proyecto,
					)
				);
			}
			
			return Response::json(
					array(
						'success'	=> false,
					)
				);
							  
		}
	}
	
	/**
	* Obtener una imagen aleatoria
	*
	*/
	public function postAjax_random_img()
	{
		if( Request::ajax() ){
			
			$path ="'".$this->pathUpload."proyectos/id_',proyecto_id,'/img_id_', id,'/'";
			
			$imagen =ProyectoImagenes::select('id', 'archivo', DB::raw("CONCAT(".$path.") AS path") )
									 ->all()
									 ->random(1);
			if( $imagen ){
				return Response::json(
						array(
							'success'	=> true,
							'imagen'		=> $imagen,
						)
					);
			}
			
		}
		
	}
	
	/**
	* Activa o desactiva filtros de categorias
	*
	*/
	public function postAjax_filtro_categoria()
	{
		if( Request::ajax() ){
			
			$id = Winput::get('id');
			$active = false;
			
			if( Sess::has('categorias') ){
				$sess_cat = Sess::get('categorias');
				
				if( count( $sess_cat) > 0 ){
					
					$categorias = Categorias::select('id')->get();
					
					if( $categorias ){
						
						foreach($categorias as $value){
							
							if( $value->id == $id ){
								
								if(Sess::has('categorias.'.$id) )
								{
									Sess::forget('categorias.'.$id);
									$active = false;
								}
								else{
									Sess::put('categorias.'.$id, true);
									$active = true;
								}
								
								break;
							}
							
						}
						
					}
				
				}
				else{
					Sess::put('categorias.'.$id, true);
					$active = true;
				}
				
			}
			else{
				Sess::put('categorias.'.$id, true);
				$active = true;
			}
			
			
			return Response::json(array(
				'success'	=> true,
				'resp'		=> $this->getIndex(),
				'cat_id'	=> $id,
				'active'	=> $active,
			));
		}
		
		
	}
	
	/**
	* Obtener registros de busqueda
	*
	*/
	public function postAjax_search()
	{
		
		if( Request::ajax() and Input::has('search') ){
			$limit=3;//default 3
			
			$proyectos = Proyectos::where(function($where){
				
										//Limpiar cadena
										//Array posición 0 limpia caracteres diferentes de letras, numeros y espacios
										//Array posición 1 reemplaza multiples espacios intermedios en blanco 
										//por uno solo espacio intermedio
										//Aplicar trim a la cadena
										$search = trim(preg_replace(
											array(
												'/[^A-Za-zñÑáéíóúÁÉÍÓÚ0-9 ]/',
												'/[ ]+/'
											), 
											array(
												'',
												' '
											), Winput::get('search') ));
										
										$arrSearch = explode(' ', $search);
										
										//$arrSearch = array(Winput::get('search'));
										$limite=8;
										$i=1;
										foreach($arrSearch as $value){
											if( $i==$limite ) break;
											
											$where->orWhere('titulo', 'LIKE', '%'.$value.'%')
												  ->orWhere('arquitectura', 'LIKE', '%'.$value.'%')
												  ->orWhere('descripcion', 'LIKE', '%'.$value.'%')
												  ->orWhere('locacion', 'LIKE', '%'.$value.'%')
												  ->orWhere('tipologia', 'LIKE', '%'.$value.'%')
												  ->orWhere('cliente', 'LIKE', '%'.$value.'%')
												  //->orWhere('status', 'LIKE', '%'.$value.'%')
												  ->orWhere('asociado', 'LIKE', '%'.$value.'%')
												  //->orWhere('dimension', 'LIKE', '%'.$value.'%')
												  ;
											$i++;
										}
									
								  })
								  ->orderBy('id', 'DESC')
								  ->take($limit)
								  ->get();
								  
			
			//Obtener plantilla de listado de inmuebles
			return Response::json(array(
				'success'	=> true,
				'view'		=> View::make('search.ajax_search_list', 
									array(
										'proyectos'=>$proyectos,
									)
								 )->render()
				)
		    );
			 
		}
		 
	}
	
	/**
	*
	*
	*/
	/*public function listaProyectos()
	{
		
		$lista_proyectos = ''; 
        if( $proyectos){
        	foreach($proyectos as $value){
            	$lista_proyectos.='<a href="" class="ver_detalle" data-p_id="'.$value->id.'">'.$value->titulo.'</a> - ';
			}
		}
		
		if( !empty($lista_proyectos) ){
			$lista_proyectos = strtoupper(substr($lista_proyectos, 0, -3));
		}
		
	}*/

}
