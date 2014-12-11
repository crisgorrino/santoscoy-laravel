<?php

class admin_ProductoCategoriasController extends BaseController {

	public function __construct()
	{
		$this->beforefilter('auth'); //bloqueo de acceso, aplicar FILTRO
	}
			
	//Usando RESTFul
	
	//Listado
	public function getIndex()
	{
		$limit=10;
		$pagesProx = 4;
		
		$categorias = ProductoCategorias::orderBy('tipo', 'asc')->orderBy('ordering', 'asc')->orderBy('nombre', 'asc');
		
		//Aplicar Trim a todos los campos input
		Input::merge(array_map('trim', Input::all()));
						
		$campo=Input::get('campo', '');
		$search=Input::get('search', '');
		
		if( !empty($campo) and !empty($search) ){
			$categorias=$categorias->where($campo, 'LIKE', '%'.$search.'%');
		}
		
		if( !empty($search) and empty($campo) ){
			$categorias=$categorias->where("id", 'LIKE', '%'.$search.'%')
					->orWhere("nombre", 'LIKE', '%'.$search.'%')
					->orWhere("tipo", 'LIKE', '%'.$search.'%');
		}
				
		////////////////////
		
		if ( Request::ajax() ) {
			
			$categorias=$categorias->paginate( $limit )
							 	   ->useCurrentRoute()
							 	   //->canShowFirstPage()
							 	   //->canShowLastPage()
							 	   ->pagesProximity( $pagesProx );
			
			return Response::json(View::make('admin.producto_categorias.categorias_ajax_list', 
				array(  
					'categorias'=>$categorias,
					//'inputs'=>$inputs,
				)
			 )->render());
			
		}
		
		$categorias=$categorias->paginate( $limit )
							   ->useCurrentRoute()
							   //->canShowFirstPage()
							   //->canShowLastPage()
							   ->pagesProximity( $pagesProx );
		//return DB::getQueryLog();
		
		//Campos por los que se puede buscar
		$fields_search = array(
			'id'		=> 'ID',
			'nombre'	=> 'Nombre', 
			'tipo'		=> 'G&eacute;nero', 
		);
		
		return View::make('admin.producto_categorias.categorias', 
				array(
				    'categorias'	=> $categorias,
				    //'inputs'		=> $inputs,
				    'fields_search'	=> $fields_search
				) 
			);
			
	}
	
	public function postIndex()
	{
		return $this->getIndex();
	}
	
	///////////
	//Editar Registro
	public function getEdit($id=null)
	{
		
		/*if( empty($id) ){
			return Redirect::to('admin/productos/categorias');
		}*/
		
		//$path="'".$this->pathUpload."proy_id_',id,'/'";
		$categoria = ProductoCategorias::/*select('*', DB::raw("CONCAT(".$path.") AS path") )->*/find($id);
		
		return View::make('admin.producto_categorias.categorias_edit', 
					array(
						'categoria'	=> $categoria,
					)
				);		
		
	}
	
	//Guardar Producto
	public function postEdit()
	{
		$this->beforeFilter('csrf', array('on' => 'post'));
		
		//reglas de validacion
		$rules = array(
			'tipo' 				=> 'required',
			'nombre' 			=> 'required|max:255',
		);

		$validation = Validator::make(Input::all(), $rules);
		if( $validation->fails() ){
			//Enviar a la vista anterior con los errores encontrados
			return Redirect::back()->withInput()->withErrors($validation);
		}
		
		$msg='';
		
		
		//Si existe el ID verificar si existe el registro en la BD
		$cat_id=Input::get('id', 0);
		
		$categoria = ProductoCategorias::find($cat_id);
		
		//Si NO se encontro registro entonces insertar, caso contrario modificar
		if( !$categoria ){
			//Insert			
			$categoria = new ProductoCategorias;//instancia de modelo
		}
		
		$categoria->nombre 				= Input::get('nombre', '');
		$categoria->tipo 				= Input::get('tipo', '');
		
		//Guardar el registro
		if( $categoria->save() ){
			
			$cat_id = $categoria->id;
			
			$msg.='<div class="desvanecer alert alert-success alert-dismissable">
					<i class="fa fa-check"></i>
					<a type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</a>
					<strong>Registro Actualizado</strong>
				</div>';
			
		}
		else{
			$msg.='<div class="desvanecer alert alert-danger alert-dismissable">
					<i class="fa fa-ban"></i>
					<a type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</a>
					<p>Error : <b>No se pudo guardar el registro</b></p>
				</div>';
		}
		
		/////////////////////////////////////////////////
		
		//
		/*if( empty($id) ){
			return Redirect::to('admin/productos/categorias');
		}*/
		
		if( !empty($msg) ){
			Session::flash('msg', $msg);
		}
		
		if( !empty($cat_id) ){
			return Redirect::to('admin/productos/categorias/edit/'.$cat_id);
		}
		else{
			return Redirect::back();
		}		
		
	}
	
	//
	public function getDelete()
	{
		return Redirect::to('admin/productos/categorias');
	}
	
	//Eliminar producto solo si no tiene vinculada una imagen
	public function postDelete()
	{
		$checkbox  = Input::get( 'eliminar', array() ); //Es array
		$msg = '';
		
		if( count($checkbox) > 0 ){
			foreach($checkbox as $key=>$value){
				
				//verificar si tiene una producto asociada
				$productos = Productos::select( DB::raw('COUNT(*) AS total') )->where('categoria_id', '=', $key)->first();
				
				//eliminar logicamente
				$categoria = ProductoCategorias::select('id', 'nombre')->where('id', '=', $key)->first();
				
				if( $productos->total > 0 ){
					
					$msg.='<div class="desvanecer alert alert-danger alert-dismissable">
							<i class="fa fa-ban"></i>
							<a type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</a>
							<p>Error : <b>La categor&iacute;a '.$categoria->nombre.' NO se Elimin&oacute; ya que tiene <strong>'.$productos->total.'</strong> productos, elim&iacute;nelos primero.</b></p>
						</div>';					
					
				}
				else{
					//eliminar registro
					if( $categoria->delete() ){
						
						$msg.='<div class="desvanecer alert alert-success alert-dismissable">
								<i class="fa fa-check"></i>
								<a type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</a>
								<p><b>Categor&iacute;a '.$categoria->nombre.' Eliminada</b></p>
							</div>';
					}
					else{
						$msg.='<div class="desvanecer alert alert-danger alert-dismissable">
							<i class="fa fa-ban"></i>
							<a type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</a>
							<p>Error : <b>Categor&iacute;a '.$categoria->nombre.' NO Eliminada</b></p>
						</div>';
					}
					
					
				}
				
			}
		}
		
		return Redirect::back()->with('msg', $msg);
		
	}
	
	//
	public function getSave_order()
	{
		return Redirect::to('admin/productos/categorias');
	}
	
	//Guardar el orden de los elementos
	public function postSave_order()
	{
		$order  = Input::get( 'order', array() ); //Es array
		$msg = '';
		
		$msgError='';
		$msgSuccess='';
		
		if( count($order) > 0 ){
			foreach($order as $key=>$value){
				
				if( empty($value) ) $value=0;
				
				$categoria = ProductoCategorias::select('id', 'ordering')->find($key);
				
				if( $categoria ){
					
					$ordering_old = $categoria->ordering;
					
					$categoria->ordering = $value;
					
					if( $categoria->save() ){
						if( $ordering_old!=$categoria->ordering ){
							$msgSuccess.='<p><b>Categor&iacute;a '.$categoria->nombre.', el orden cambio de <strong>'.$ordering_old.'</strong> a <strong>'.$categoria->ordering.'</strong>.</b></p>';
						}
					}
					else{
						$msgError.='<p><b>Orden no guardado para la categor&iacute;a '.$categoria->nombre.'.</b></p>';
					}
					
				}
				else{
					$msgError.='<p><b>No existe la categor&iacute;a con ID: '.$key.'</b></p>';
				}
				
			}
		}
		
		if( !empty($msgSuccess) ){
			$msg.='<div class="desvanecer alert alert-success alert-dismissable">
					<i class="fa fa-check"></i>
					<a type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</a>
					'.$msgSuccess.'
				</div>';
		}
		
		if( !empty($msgError) ){
			$msg.='<div class="desvanecer alert alert-danger alert-dismissable">
					<i class="fa fa-ban"></i>
					<a type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</a>
					Error : '.$msgError.'
				</div>';
		}
		
		return Redirect::back()->with('msg', $msg);
		
	}
	
}

?>