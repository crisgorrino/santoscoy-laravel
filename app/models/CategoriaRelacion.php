<?php

class CategoriaRelacion extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'categoria_proyecto';
	//protected $timestamp = false;
	
	public function categoria()
    {
        return $this->hasOne('Categorias', 'categoria_id', 'id');
    }
	
	public function proyecto()
	{
		return $this->hasOne('Proyectos', 'proyecto_id', 'id');
	}


}
