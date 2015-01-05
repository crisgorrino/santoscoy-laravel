<?php

class admin_EditorialController extends BaseController {

	public function __construct()
	{
		$this->beforefilter('auth'); //bloqueo de acceso, aplicar FILTRO
	}
			
	//Usando RESTFul
	
	/**
	* Listado
	*
	*/
	public function getIndex()
	{
		$limit=10;
		$pagesProx = 4;
		
		$path="'".$this->pathUpload."editorial/id_',id,'/'";
		
		$editorial = Editorial::publishedNotRemoved()
							  ->select('*', DB::raw("CONCAT(".$path.") AS path") )
							  ->orderBy('no_publicacion', 'DESC');
		//echo "<pre>";		  
		//dd( print_r(get_class_methods($proyectos) ) );
						
		$campo		= Winput::get('campo');
		$search		= Winput::get('search');
		
		if( !empty($campo) and !empty($search) ){
			$editorial->where($campo, 'LIKE', '%'.$search.'%');
		}
		
		if( !empty($search) and empty($campo) ){
			$editorial->where("id", 'LIKE', '%'.$search.'%')
					->orWhere("no_publicacion", 'LIKE', '%'.$search.'%')
					->orWhere("titulo", 'LIKE', '%'.$search.'%');
		}
		
				
		////////////////////
		
		$editorial=$editorial->paginate( $limit )
							 //->useCurrentRoute()
							 //->canShowFirstPage()
							 //->canShowLastPage()
							 ->pagesProximity( $pagesProx );
		
		if ( Request::ajax() ) {
						
			return Response::json(View::make('admin.editorial.editorial_ajax_list', 
				array(  
					'editorial'=>$editorial,
				)
			 )->render());
			
		}
		
		//Campos por los que se puede buscar
		$fields_search = array(
			'id'			=> 'ID',
			'no_publicacion'=> 'No. Publicación', 
			'titulo'		=> 'Título'
		);
		
		return View::make('admin.editorial.editorial', 
				array(
				    'editorial'		=> $editorial,
				    //'inputs'		=> $inputs,
				    'fields_search'	=> $fields_search
				) 
			);
			
	}
	
	
	public function postIndex()
	{
		return $this->getIndex();
	}
	
	/**
	* Editar Registro
	* Si no existe $id entonces se considera registro nuevo
	*
	*/
	public function getEdit($id=null)
	{
		
		$path="'".$this->pathUpload."editorial/id_',id,'/'";
		$editorial = Editorial::select('*', DB::raw("CONCAT(".$path.") AS path") )->find($id);
		
		return View::make('admin.editorial.editorial_edit', 
					array(
						'editorial'	=> $editorial,
					)
				);		
		
	}
	
	/**
	* Editar Registro
	*
	*/
	public function postEdit()
	{
		$this->beforeFilter('csrf', array('on' => 'post'));
		
		$id=Input::get('id', 0);
		
		//reglas de validacion
		$rules = array(
			//'no_publicacion'	=> 'required|integer|unique:editorial,no_publicacion',
			'no_publicacion'	=> 'required|integer|unique:editorial,no_publicacion,'.$id,
			'titulo' 			=> 'required|max:150',
			'descripcion'		=> 'required|max:255',
			'url'				=> 'max:255',
		);

		$validation = Validator::make(Input::all(), $rules);
		if( $validation->fails() ){
			//Enviar a la vista anterior con los errores encontrados
			return Redirect::back()->withInput()->withErrors($validation);
		}
		
		$msg='';
		$msgError='';
		$msgSuccess='';
		
		$nameArchivoOrigen='';
		
		//Si existe el ID verificar si existe el registro en la BD		
		$editorial = Editorial::find($id);
		
		//Si NO se encontro registro entonces insertar, caso contrario modificar
		if( !$editorial ){
			//Insert			
			$editorial = new Editorial;//instancia de modelo
		}
		
		$editorial->no_publicacion		= Winput::get('no_publicacion');
		$editorial->titulo 				= Winput::get('titulo');
		$editorial->descripcion 		= Winput::get('descripcion');
		$editorial->url					= Winput::get('url');
		
		//Guardar el registro
		if( $editorial->save() ){
			
			$id = $editorial->id;
			
			$msgSuccess.='<strong>Registro Guardado</strong>';			
						
			//Si existe archivo de color de muestra
			if( Input::hasFile('imagen') ){
				
				//Path
				$path=public_path().'/'.$this->pathUpload.'editorial/id_'.$id.'/';
				
				//Eliminar carpeta si existe
				if ( File::exists($path) ){
					File::deleteDirectory($path);
				}
							
				$inputFile=Input::file('imagen');//Input del formulario
				//$inputFile=Winput::get('img_banner', array('trim'=> true, 'clean'=> true, 'sanitize'=> true, 'image'=> true) );//Input del formulario
				$inputPath=$inputFile->getRealPath();
				
				$pos=strrpos($inputFile->getClientOriginalName(), '.');
				$inputName=substr($inputFile->getClientOriginalName(), 0, $pos);
				$inputExt=substr(strrchr($inputFile->getClientOriginalName(),'.'),1);
				
				////////#####  Upload File #####////////
				//Instanciar clase para subir archivo(s)
				$upload = new classUpload\upload;
				$upload->upload($inputPath, 'es_ES');
				
				//Nuevo nombre de archivo
				$upload->file_new_name_body=$inputName;
				$upload->file_new_name_ext=$inputExt;
				//Maximo tamaño del archivo
				$upload->file_max_size = '10485760'; //10MB=10485760 / 5MB=5242880  / 1KB=1024
				//Extensiones permitidas
				$upload->allowed = array('image/png','image/jpg', 'image/jpeg');
				//Maximo de pixeles de la imagen, si es mayor no se carga
				$upload->image_max_width 	= 10000;
				$upload->image_max_height 	= 10000;
				
				//calidad
				$upload->jpeg_quality = 100;
												
				$nameArchivoOrigen='';
				if ($upload->uploaded) {
					
					$upload->file_safe_name=true;
					//$upload->file_name_body_pre = 'redim_';
					$upload->image_resize = true;
					$upload->image_convert = 'jpg';
					$upload->image_x = 480;
					$upload->image_y = 631;
					//$upload->image_ratio_y = true;
					$upload->image_ratio_crop      = 't';
					//$upload->image_ratio_fill      = true;
					
					//calidad
					$upload->jpeg_quality = 100;
										
					$upload->Process($path);
					if ($upload->processed) {						
						$nameArchivoOrigen=$upload->file_dst_name_body.".".$upload->file_dst_name_ext;
						
						//Redimencionar
						$upload->file_new_name_body=$inputName;
						$upload->file_new_name_ext=$inputExt;
						$upload->file_safe_name=true;
						$upload->file_name_body_pre = 'thumb_';
						$upload->image_resize = true;
						$upload->image_convert = 'jpg';
						$upload->image_x = 92;
						$upload->image_y = 120;
						//$upload->image_ratio_y = true;
						$upload->image_ratio_crop= 't';
						//$upload->image_ratio_fill      = true;
						
						//calidad
						$upload->jpeg_quality = 100;
		
						$upload->Process($path);
						if ($upload->processed) {
							//$nameArchivoDetalle=$upload->file_dst_name_body.".".$upload->file_dst_name_ext;
							//$msg.='<br />Imagen renombrada <b class="red">'.$nameArchivoDetalle.'</b> , resized x='.$ancho.' y='.$alto.', convertida a JPEG';
							//$upload->Clean();
						}	
												
						//###################    ##################//		
						if( !empty($nameArchivoOrigen) ){
							
							//guardar Registro							
							$editorial->archivo = $nameArchivoOrigen;
								
							if($editorial->save()){
								$msgSuccess.='<p>Imagen Muestra <b>'.$nameArchivoOrigen.'</b> copiado</p>';									
							}
							else{
								$msgError.='<p>Error: <b>Registro no guardado</b></p>';
							}
							
						}
						// $upload->Clean();
					
					} else {
						$msgError.='<p>Error : <b>'.$upload->error.'</b></p>';							
					}
					
					
				} 
				else{
					$msgError.='<p>Error : <b>No se puede cargar el Archivo</b></p>';
				}
				
			}
			
		}
		else{
			$msgError.='<p><b>No se pudo guardar el registro</b></p>';
		}
		
		/////////////////////////////////////////////////
		
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
		
		if( !empty($msg) ){
			Session::flash('msg', $msg);
		}
		
		if( !empty($id) ){
			return Redirect::to('admin/editorial/edit/'.$id);
		}
		else{
			return Redirect::back();
		}
		
	}
	
	//
	public function getDelete()
	{
		return Redirect::to('admin/editorial');
	}
	
	/**
	* Eliminar registro y si tiene imagenes vinculadas eliminarlas
	*
	*/
	public function postDelete()
	{
		$checkbox  = Input::get( 'eliminar', array() ); //Es array
		$msg = '';
		
		if( count($checkbox) > 0 ){
			foreach($checkbox as $key=>$value){
				
				//verificar si tiene una orden asociada
				//$orden_items = OrdenItem::select('id')->where('proyecto_id', '=', $key)->first();
				
				//eliminar logicamente
				$editorial = Editorial::select('id', 'titulo')->where('id', '=', $key)->first();
				
				if( false )
				{
					
					$editorial->removed = 1;
					
					if( $editorial->save() ){
						$msg.='<div class="desvanecer alert alert-success alert-dismissable">
								<i class="fa fa-check"></i>
								<a type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</a>
								<p><b>Producto '.$editorial->titulo.' Eliminado</b></p>
							</div>';
					}
					else{
						$msg.='<div class="desvanecer alert alert-danger alert-dismissable">
							<i class="fa fa-ban"></i>
							<a type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</a>
							<p>Error : <b>Producto '.$editorial->titulo.' NO Eliminado</b></p>
						</div>';
					}
					
					
				}
				else{
					//eliminar registro y archivos, esto está en el modelo
					if( $editorial->delete() ){
						
						//eliminar archivos
						$msg.='<div class="desvanecer alert alert-success alert-dismissable">
								<i class="fa fa-check"></i>
								<a type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</a>
								<p><b>Producto '.$editorial->titulo.' e im&aacute;genes asociadas Eliminadas</b></p>
							</div>';
					}
					else{
						$msg.='<div class="desvanecer alert alert-danger alert-dismissable">
							<i class="fa fa-ban"></i>
							<a type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</a>
							<p>Error : <b>Producto '.$editorial->titulo.' NO Eliminado</b></p>
						</div>';
					}
					
					
				}
				
			}
		}
		
		return Redirect::back()->with('msg', $msg);
		
	}
	
}

?>