<?php

class Proyectos extends Eloquent {
	
	public $pathUpload = '';
	
	public function __construct(){
		$base = new BaseController;
		$this->pathUpload=$base->pathUpload;
	}

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'proyectos';
	
	/**
	* Ambito para filtrar por solu publicados
	*
	*/
	public function scopePublished($query)
	{
		return $query->where('published', '=', 1);
	}
	
	/**
	* Ambito para filtrar por solu publicados
	*
	*/
	public function scopeNotRemoved($query)
	{
		return $query->where('removed', '=', 0);
	}
	
	/**
	* Ambito para filtrar solo los publicados y que no esten como eliminados
	*
	*/
	public function scopePublishedNotRemoved($query)
	{
		return $query->where('published', '=', 1)->where('removed', '=', 0);
	}
	
	
	
	//get detalle
	public function detalle($id)
	{
		return Proyectos::select('proyectos.*')
				 ->where('id', '=', $id)
				 ->where('proyectos.published', '=', 1)
				 //fotos que no esten eliminadas logicamente
				 ->where('proyectos.removed', '=', 0)
				 //->whereNotNull('productos.archivo')
				 //->where('productos.archivo', '!=', '')
				 ->orderBy('proyectos.created_at', 'DESC')
				 ->orderBy('proyectos.id', 'DESC')
				 ;
	}
		
	//Una Proyecto tiene muchas categorias
	public function categorias()
	{
								   //Modelo       //Tabla pivote      //Id proyecto //id relacion
		return $this->belongsToMany('Categorias', 'categoria_proyecto', 'proyecto_id', 'categoria_id')->withPivot('id')->orderBy('pivot_id', 'asc');
	}
	
	//Un proyecto tiene una o varias imagenes
	public function imagenes()
	{
		$path="'".$this->pathUpload."proyectos/id_',proyecto_id,'/img_id_', id,'/'";
		
		return $this->hasMany('ProyectoImagenes', 'proyecto_id', 'id')
					->select('*', DB::raw("CONCAT(".$path.") AS path") )
					->orderBy('ordering', 'ASC')
					->orderBy('created_at', 'DESC');
	}
	
	//Obtener la primer imagen del proyecto
	public function imagen()
	{
		
		//$prefix=DB::getTablePrefix();
		//$path="'".app_path()."/',";
		$path ="'".$this->pathUpload."proyectos/id_',proyecto_id,'/img_id_', id,'/'";
		
		return $this->hasOne("ProyectoImagenes", 'proyecto_id', 'id')
					->select('*', DB::raw("CONCAT(".$path.") AS path") )
					->orderBy('ordering', 'ASC')
					->orderBy('created_at', 'DESC');
		
	}
	
	public function path_img()
	{
		return $this->pathUpload.'proyectos/id_'.$this->id.'/img/';
	}	
	
	//Eliminacion de registro y sus archivos
	public function delete()
	{
		//Eliminar registros en DB		
		//ProductoImagenes::where('proyecto_id', '=', $this->id)->delete();
		
		CategoriaRelacion::where('proyecto_id', '=', $this->id)->delete();
		
		//Eliminar archivos archivo
		$path = public_path().'/'.$this->pathUpload.'proyectos/id_'.$this->id.'/';
		if ( File::exists($path) ){
			File::deleteDirectory($path);
		}	
		
		return parent::delete();
	}
	
}
