<?php

class admin_ProyectosController extends BaseController {

	public function __construct()
	{
		$this->beforefilter('auth'); //bloqueo de acceso, aplicar FILTRO
	}
			
	//Usando RESTFul
	
	/**
	* Listado de Proyectos
	*
	*/
	public function getIndex()
	{
		$limit=10;
		$pagesProx = 4;
		
		$proyectos = Proyectos::with('categorias', 'imagen')
							  ->publishedNotRemoved()
							  ->orderBy('created_at', 'desc')
							  ->orderBy('id', 'desc');
		//echo "<pre>";		  
		//dd( print_r(get_class_methods($proyectos) ) );
						
		$campo		= Winput::get('campo');
		$search		= Winput::get('search');
		
		if( !empty($campo) and !empty($search) ){
			$proyectos->where($campo, 'LIKE', '%'.$search.'%');
		}
		
		if( !empty($search) and empty($campo) ){
			$proyectos->where("id", 'LIKE', '%'.$search.'%')
					//->orWhere("sku", 'LIKE', '%'.$search.'%')
					->orWhere("nombre", 'LIKE', '%'.$search.'%')
					->orWhere("modelo", 'LIKE', '%'.$search.'%');
		}
		
		if( Input::has('categoria_id') ){
			
			$proyectos->whereHas('categorias', function($query){
											   	   $query->where(function($where){
														foreach(Winput::get('categoria_id') as $cat){
													   		$where->orWhere('categoria_id', '=', $cat);
														}
												    });
											   });
			
			/*$proyectos->with( array(
								'categorias'=> function($query){
											
											$query->where(function($where){
														foreach(Winput::get('categoria_id') as $cat){
													   		$where->orWhere('categoria_id', '=', $cat);
														}
												    });
								}
							   )
							 );*/
			
		}
				
		////////////////////
		
		$proyectos=$proyectos->paginate( $limit )
							 ->useCurrentRoute()
							 //->canShowFirstPage()
							 //->canShowLastPage()
							 ->pagesProximity( $pagesProx );
		
		if ( Request::ajax() ) {
						
			return Response::json(View::make('admin.proyectos.proyectos_ajax_list', 
				array(  
					'proyectos'=>$proyectos,
					//'inputs'=>$inputs,
				)
			 )->render());
			
		}
		
		//return DB::getQueryLog();
		
		$categorias = Categorias::orderBy('ordering', 'ASC')->get();
		
		//Campos por los que se puede buscar
		$fields_search = array(
			'id'			=> 'ID',
			'titulo'		=> 'Título', 
			'locacion'		=> 'Locación', 
			'tipologia'		=> 'Tipología',
			'cliente'		=> 'Cliente',
			'status'		=> 'Status',
			'asociado'		=> 'Asociado',
		);
		
		return View::make('admin.proyectos.proyectos', 
				array(
					'categorias'	=> $categorias,
				    'proyectos'		=> $proyectos,
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
		
		$proyecto = Proyectos::with('categorias', 'imagenes')->find($id);
		
		$cat = Categorias::orderBy('ordering', 'ASC')->get();
		
		return View::make('admin.proyectos.proyectos_edit', 
					array(
						'proyecto'	=> $proyecto,
						'cat'		=> $cat
					)
				);		
		
	}
	
	//Guardar Producto
	public function postEdit()
	{
		$this->beforeFilter('csrf', array('on' => 'post'));
		
		//reglas de validacion
		$rules = array(
			'categoria_id' 		=> 'required|array',
			'titulo' 			=> 'required|max:255',
			'descripcion'		=> 'required',
			'locacion'			=> 'required|max:100',
			'tipologia'			=> 'required|max:100',
			'cliente'			=> 'required|max:150',
			'status'			=> 'required|max:100',
			'asociado'			=> 'required|max:150',
			'dimension'			=> 'required|max:100'
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
		$p_id=Input::get('id', 0);
		
		$proyecto = Proyectos::find($p_id);
		
		//Si NO se encontro registro entonces insertar, caso contrario modificar
		if( !$proyecto ){
			//Insert			
			$proyecto = new Proyectos;//instancia de modelo
		}
		
		$proyecto->titulo 				= Winput::get('titulo');
		$proyecto->descripcion 			= Winput::get('descripcion');
		$proyecto->locacion				= Winput::get('locacion');
		$proyecto->tipologia			= Winput::get('tipologia');
		$proyecto->cliente 				= Winput::get('cliente');
		$proyecto->status				= Winput::get('status');
		$proyecto->asociado				= Winput::get('asociado');
		$proyecto->dimension			= Winput::get('dimension');
		
		//Guardar el registro
		if( $proyecto->save() ){
			
			$p_id = $proyecto->id;
			
			$msgSuccess.='<strong>Registro Guardado</strong>';			
						
			//Eliminar las categorias asociadas a este proyecto
			$categorias = CategoriaRelacion::where('proyecto_id', '=', $p_id)->delete();
			
			//Agregar las categorías nuevamente
			$categorias = Winput::get('categoria_id');
			foreach($categorias as $value){
				$categoria = new CategoriaRelacion;
				$categoria->categoria_id = $value;
				$categoria->proyecto_id = $p_id;
				if( !$categoria->save() ){
					$msgError.='<p><b>No se pudo guardar la categoría</b></p>';
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
		
		if( !empty($p_id) ){
			return Redirect::to('admin/proyectos/edit/'.$p_id);
		}
		else{
			return Redirect::back();
		}
		
	}
	
	//
	public function getDelete()
	{
		return Redirect::to('admin/proyectos');
	}
	
	//Eliminar proyecto solo si no tiene vinculada una imagen
	public function postDelete()
	{
		$checkbox  = Input::get( 'eliminar', array() ); //Es array
		$msg = '';
		
		if( count($checkbox) > 0 ){
			foreach($checkbox as $key=>$value){
				
				//verificar si tiene una orden asociada
				//$orden_items = OrdenItem::select('id')->where('proyecto_id', '=', $key)->first();
				
				//eliminar logicamente
				$proyecto = Proyectos::select('id', 'titulo')->where('id', '=', $key)->first();
				
				if( false )
				{
					
					$proyecto->removed = 1;
					
					if( $proyecto->save() ){
						$msg.='<div class="desvanecer alert alert-success alert-dismissable">
								<i class="fa fa-check"></i>
								<a type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</a>
								<p><b>Producto '.$proyecto->titulo.' Eliminado</b></p>
							</div>';
					}
					else{
						$msg.='<div class="desvanecer alert alert-danger alert-dismissable">
							<i class="fa fa-ban"></i>
							<a type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</a>
							<p>Error : <b>Producto '.$proyecto->titulo.' NO Eliminado</b></p>
						</div>';
					}
					
					
				}
				else{
					//eliminar registro y archivos, esto está en el modelo
					if( $proyecto->delete() ){
						
						//eliminar archivos
						$msg.='<div class="desvanecer alert alert-success alert-dismissable">
								<i class="fa fa-check"></i>
								<a type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</a>
								<p><b>Producto '.$proyecto->titulo.' e im&aacute;genes asociadas Eliminadas</b></p>
							</div>';
					}
					else{
						$msg.='<div class="desvanecer alert alert-danger alert-dismissable">
							<i class="fa fa-ban"></i>
							<a type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</a>
							<p>Error : <b>Producto '.$proyecto->titulo.' NO Eliminado</b></p>
						</div>';
					}
					
					
				}
				
			}
		}
		
		return Redirect::back()->with('msg', $msg);
		
	}
	
	
	/////////////////////////////////
	//////////// IMAGENES ///////////
	/////////////////////////////////
	
	public function listaImagenes($p_id)
	{
		$proyecto = Proyectos::with('imagenes')->where('id', '=', $p_id)->first();
		
		$salida='';
		if( count($proyecto->imagenes) > 0 ){
			
			ob_start();
			
			foreach( $proyecto->imagenes as $img ){
				if( is_file($img->path.$img->archivo) ){ 
					?>
                    <div class="img-cont col-md-4" id="img_<?php echo $img->id; ?>" style="display:none;">
                        <!-- Default box -->
                        <div class="box">
                            <div class="box-header">
                                <?php /*?><h3 class="box-title">Default Box (button tooltip)</h3><?php */?>
                                <div class="box-tools pull-right">
                                    <?php /*?><a class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></a><?php */?>
                                </div>
                            </div>
                            <div class="box-body">
                            	<img src="<?php echo url($img->path.'thumb_'.$img->archivo); ?>" alt="<?php echo $proyecto->titulo; ?>" style="display:block; margin:1% auto; width:100%"><br />
                                    <span><label>Orden:&nbsp;</label><input type="text" name="orden[<?php echo $img->id; ?>]" size="4" value="<?php echo $img->ordering; ?>" class="validate[required, custom[integer]]" data-prompt-position="topLeft"/></span>&nbsp;
                                    <span id="loader_order_img<?php echo $img->id; ?>">
                                        
                                        <a class="btn btn-primary btn-sm save-img" onclick="orderingImg('<?php echo $img->id; ?>');"><i class="fa fa-save"></i>&nbsp;Guardar</a>
                                    </span>
                                    <span id="loader_del_s<?php echo $img->id; ?>">
                                        <a class="btn btn-danger btn-sm" title="" onclick="delImg('<?php echo $img->id; ?>');">
                                            <i class="fa fa-times"></i>
                                        </a>
                                    </span>
                            </div><!-- /.box-body -->
                            <div class="box-footer">&nbsp;</div><!-- /.box-footer-->
                        </div><!-- /.box -->
                    </div>
                    <?php
				}
			}
			
			$salida = ob_get_clean();
		}
		
		return $salida;
		
	}
	
	//
	public function getAjax_add_img()
	{
		return Redirect::to('admin/proyectos');
	}
	
	//Agregar imagen con AJAX
	public function postAjax_add_img()
	{
		$msg='';
		$files = array();
		if( Request::ajax() ){
			//Si existe archivo de imagen e imagen de logo
			if( Input::hasFile('files') and Input::has('p_id') ){
				
				$p_id=Input::get('p_id');
				
				$inputFiles=Input::file('files');//Input del formulario es un array
				
				if( is_array($inputFiles) )
				{
					
					foreach($inputFiles as $inputFile)
					{ 
						//guardar Registro
						$imagen = new ProyectoImagenes; //instancia del modelo de la clase Producto
						
						$imagen->proyecto_id= $p_id;
						
						//$imagen->archivo	= $nameArchivoOrigen;
						//$imagen->logo 		= $nameLogoOrigen;
						
						$inputPath=$inputFile->getRealPath();
							
						$pos=strrpos($inputFile->getClientOriginalName(), '.');
						$inputName=substr($inputFile->getClientOriginalName(), 0, $pos);
						$inputExt=substr(strrchr($inputFile->getClientOriginalName(),'.'),1);
						
						if($imagen->save()){
							
							//Path
							$pre_path = $this->pathUpload.'proyectos/id_'.$p_id.'/img_id_'.$imagen->id.'/';
							$path=public_path().'/'.$pre_path;
							
							////////#####  Upload File #####////////
							//Instanciar clase para subir archivo(s)
							$upload = new classUpload\upload;
							
							////////////// IMAGEN ///////////////							
							$upload->upload($inputPath, 'es_ES');
							
							//Nuevo nombre de archivo
							$upload->file_new_name_body=$inputName;
							$upload->file_new_name_ext=$inputExt;
							//Maximo tamaño del archivo
							$upload->file_max_size = '5242880'; //10MB=10485760 / 5MB=5242880  / 1KB=1024
							//Extensiones permitidas
							$upload->allowed = array('image/png','image/jpg', 'image/jpeg');
							//Maximo de pixeles de la imagen, si es mayor no se carga
							$upload->image_max_width 	= 1000;
							$upload->image_max_height 	= 1000;
							
							$upload->image_min_width 	= 425;
							$upload->image_min_height 	= 425;
							
							//calidad
							$upload->jpeg_quality = 100;
							
							$nameArchivoOrigen='';
							if ($upload->uploaded) {
								
								$upload->file_safe_name=true;
								//$upload->file_name_body_pre = 'redim_';
								$upload->image_resize = false;
								//$upload->image_convert = 'jpg';
								//$upload->image_x = 619;
								//$upload->image_y = 471;
								//$upload->image_ratio_y = true;
								//$upload->image_ratio_crop      = true;
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
									//$upload->image_convert = 'jpeg';
									$upload->image_x = 120;
									$upload->image_y = 120;
									//$upload->image_ratio_y = true;
									$upload->image_ratio_crop= 't';
									
									//calidad
									$upload->jpeg_quality = 100;
					
									$upload->Process($path);
									if ($upload->processed) {
										//$nameArchivoDetalle=$upload->file_dst_name_body.".".$upload->file_dst_name_ext;
										//$msg.='<br />Imagen renombrada <b class="red">'.$nameArchivoDetalle.'</b> , resized x='.$ancho.' y='.$alto.', convertida a JPEG';
										//$upload->Clean();
									}
																		
									$files['name'] 	= $nameArchivoOrigen;
									$files['size']	= $upload->file_src_size;
									$files['type']	= $upload->file_src_mime;
									$files['url']	= asset($pre_path.$nameArchivoOrigen);
									//$files['thumbnailUrl'] = asset($pre_path.'thumb_zoom_'.$nameArchivoOrigen);
									$files['thumbnailUrl'] = asset($pre_path.'thumb_'.$nameArchivoOrigen);
									//$files['thumbnailUrl'] = asset($pre_path.$nameArchivoOrigen);
									$files['deleteUrl'] = asset($pre_path.'?file='.$nameArchivoOrigen);
									$files['deleteType'] = "DELETE";
									$files['img_id'] = $imagen->id;
									
									// $upload->Clean();
								
								} else {
									
									$msg.='<div class="alert alert-danger alert-dismissable">
											<i class="fa fa-ban"></i>
											<a type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</a>
											<p>Error : <b>'.$upload->error.'</b></p>
										</div>';
									$files['error']	= $upload->error;
									$files['name'] 	= $nameArchivoOrigen;
									$files['size']	= '';
									$files['type']	= '';
									$files['url']	= '';
									$files['thumbnailUrl'] = '';
									//$files['thumbnailUrl'] = '';
									$files['deleteUrl'] = '';
									$files['deleteType'] = "DELETE";
									$files['img_id'] = $imagen->id;
								}
								
								
							} 
							else{
								dd(' simon');
								$msg.='<div class="alert alert-danger alert-dismissable">
										<i class="fa fa-ban"></i>
										<a type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</a>
										<p>Error : <b>No se puede cargar el Archivo</b></p>
									</div>';
									
								$files['error']	= "No se puede cargar el Archivo";
								$files['name'] 	= $nameArchivoOrigen;
								$files['size']	= '';
								$files['type']	= '';
								$files['url']	= '';
								$files['thumbnailUrl'] = '';
								//$files['thumbnailUrl'] = '';
								$files['deleteUrl'] = '';
								$files['deleteType'] = "DELETE";
								$files['img_id'] = $imagen->id;
							}
							
							
							//###################    ##################//		
							if( !empty($nameArchivoOrigen) ){
								
								//guardar Registro
								//$imagen = new ImagenesMosaico; //instancia del modelo de la clase Producto
								
								$imagen->archivo	= $nameArchivoOrigen;
							
								if($imagen->save()){
									$msg.='<div class="alert alert-success alert-dismissable">
										<i class="fa fa-check"></i>
										<a type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</a>
										<p>Archivo <b>'.$nameArchivoOrigen.'</b> copiado</p>
									</div>';
									
								}
								else{
									$msg.='<div class="alert alert-danger alert-dismissable">
											<i class="fa fa-ban"></i>
											<a type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</a>
											<p>Error: <b>Registro no guardado, intenta nuevamente</b></p>
										</div>';
																		
								}
								
								
								
								
							}
							///////////////////////////////////////////////////////////
							
						}
						else{
							
							$msg.='<div class="alert alert-danger alert-dismissable">
									<i class="fa fa-ban"></i>
									<a type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</a>
									<p>Error: <b>Registro no guardado, intenta nuevamente</b></p>
								</div>';
								
								$files['error']	= "Registro no guardado, intenta nuevamente";
								$files['name'] 	= $inputName.'.'.$inputExt;
								$files['size']	= '';
								$files['type']	= '';
								$files['url']	= '';
								$files['thumbnailUrl'] = '';
								//$files['thumbnailUrl'] = '';
								$files['deleteUrl'] = '';
								$files['deleteType'] = "DELETE";
								$files['img_id'] = $imagen->id;
															
						}
					}
															
					$salida = $this->listaImagenes($p_id);
											
					//return Response::json( array('success'=>200) );			
					
					return Response::json(
						/*array(
							'success' => true,
							'p_id'	  => $p_id,
							'msg'	  => $msg,
							'salida'  => $salida,
							'result'  => array('files' =>array($files) ),
							
						)*/
						array(
							'files' =>array($files), 
							'success' => true,
							'p_id'	  => $p_id,
							'msg'	  => $msg,
							'salida'  => $salida							
						)
						, 200
					);
					
				}
				
				
			}
			else{
				
				$files['error']	= "Imagen faltante o corrompida";
				$files['name'] 	= '';
				$files['size']	= '';
				$files['type']	= '';
				$files['url']	= '';
				$files['thumbnailUrl'] = '';
				//$files['thumbnailUrl'] = '';
				$files['deleteUrl'] = '';
				$files['deleteType'] = "DELETE";
				$files['img_id'] = '';
				
				return Response::json(
						/*array(
							'success' => true,
							'p_id'	  => $p_id,
							'msg'	  => $msg,
							'salida'  => $salida,
							'result'  => array('files' =>array($files) ),
							
						)*/
						array(
							'files' =>array($files), 
							'success' => false,
							'p_id'	  => '',
							'msg'	  => $msg,
							'salida'  => '',
						)
						, 200
					);
			}
		}
		
	}
	
	//
	public function getAjax_delete_img()
	{
		return Redirect::to('admin/proyectos');
	}
	
	//Eliminar imagen con AJAX
	public function postAjax_delete_img()
	{
		
		if( Request::ajax() ){
			
			$bandera=false;
			
			if( Input::has('img_id') and Input::has('p_id') ){
				
				$imagen = ProyectoImagenes::find( Input::get('img_id') );
			
				if( $imagen ){
					
					if( $imagen->delete() ){
						
						$path=public_path().'/'.$this->pathUpload.'proyectos/id_'.Input::get('p_id').'/img_id_'.$imagen->id.'/';
						
						if ( File::exists($path) ){
							File::deleteDirectory($path);
						}
						
						$bandera=true;
					}
					
					
				}
				
			}
			
			if( $bandera===true ){
				
				return Response::json(
					array(
						'success' => true,
						'img_id'	  => $imagen->id,
						'p_id'	  => $imagen->proyecto_id,
					)
				);
				
			}
			else{
				
				return Response::json(
					array(
						'success' => false,
						'id'	  => '',
					)
				);
				
			}
			
		}
		
		
	}
	
	
	//
	public function getAjax_ordering_img()
	{
		return Redirect::to('admin/proyectos');
	}
	
	//Ordenar las imagenes con AJAX
	public function postAjax_ordering_img()
	{
		if( Request::ajax() ){
			
			if( Input::has('orden') and Input::has('p_id') ){
				
				$arrOrden = Input::get('orden');
				$p_id	  = Input::get('p_id');
				
				foreach($arrOrden as $key => $value){
					
					$imagen = ProyectoImagenes::where('id', '=', $key)->where('proyecto_id', '=', $p_id )->first();
					
					if($imagen){
						$imagen->ordering = $value;
						$imagen->save();
					}
					
				}
				
				$salida = $this->listaImagenes($p_id);
											
				return Response::json(
							array(
								'success' => true,
								'p_id'	  => $p_id,
								'salida'  => $salida,
							)
						);
				
			}						
						
		}
		
	}
	
}

?>