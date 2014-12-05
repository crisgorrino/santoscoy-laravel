<?php

class ProyectoImagenes extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'proyecto_imagenes';
	
	
	//Un imagen pertenece a un producto
    public function proyecto()
    {
		return $this->belongsTo('Proyectos', 'id', 'proyecto_id');
    }
	
	
}
