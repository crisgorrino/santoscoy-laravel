<?php

class Categorias extends Eloquent {
	
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
	protected $table = 'categorias';
	protected $timestamp = false;
	
	public function categoriaRelacion()
    {
		return $this->belongsToMany('CategoriaRelacion', 'categoria_proyecto', 'categoria_id', 'proyecto_id');
    }
	
	//tiene varios proyectos
	public function proyectos(){
		return $this->belongsToMany('Proyectos', 'categoria_proyecto', 'categoria_id', 'proyecto_id');
	}
	
	//Una orden tiene varios items
    public function proyectos_pag()
    {
		$limit=12;
		
		$prefix=DB::getTablePrefix();
		$path="'".$this->pathUpload."fotos/u_id_',".$prefix."fotos.user_id,'/f_id_', ".$prefix."fotos.id,'/'";
		
        return $this->belongsToMany('Fotos', 'etiquetas_fotos', 'etiqueta_id', 'foto_id')
					->select('*',DB::raw("CONCAT(".$path.") AS path"))
					->where('fotos.privada', '=', 0)
					//fotos que no esten eliminadas logicamente
					->where('fotos.removed', '=', 0)
					->whereNotNull('fotos.archivo')
				    ->where('fotos.archivo', '!=', '')
					->paginate( $limit );
		
    }

}
