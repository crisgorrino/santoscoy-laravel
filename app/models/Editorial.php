<?php

class Editorial extends Eloquent {
	
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
	protected $table = 'editorial';
	
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
	
	
	//Eliminacion de registro y sus archivos
	public function delete()
	{
		//Eliminar registros en DB		
		//ProductoImagenes::where('proyecto_id', '=', $this->id)->delete();
		
		//Eliminar archivos archivo
		$path = public_path().'/'.$this->pathUpload.'editorial/id_'.$this->id.'/';
		if ( File::exists($path) ){
			File::deleteDirectory($path);
		}	
		
		return parent::delete();
	}
	
}
