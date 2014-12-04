<?php

class UserLoginController extends BaseController {
	
	//Login Ajax
	public function adminLogin()
	{
		$this->beforeFilter('csrf', array('on' => 'post'));
		
		$msg=array();
		
		if( Request::ajax() ){
			
			$remember=Input::get('remember', 0);
			
			//reglas de validacion
			$rules = array(
				'email' 	=> 'required|max:255',
				'password' 	=> 'required|max:20',
			);
	
			$validation = Validator::make(Input::all(), $rules);
			if( $validation->fails() ){
				//Enviar errores encontrados
				return Response::json(
					array(
						'success' => false,
						'msg'  => $validation->getMessageBag()->toArray()
					)
				);
				//Enviar a la vista anterior con los errores encontrados
				//return Redirect::back()->withInput()->withErrors($validation);
			}
			
			$user = User::where(function($where){
							$where->where('email', Input::get('email'))
							->orWhere('username', Input::get('email'));
						})
						->first();
			
			if(!$user) {
				$attempt = false;
			} else {
				$credentials = array(
					'email' 	=> $user->email,
					'password' 	=> Input::get('password'),
					'status'	=> 'A',//Que este activo
					'nivel_id'	=> '1',//Que su nivel sea Administrador
				);
				
				$attempt = Auth::user()->attempt($credentials, $remember);
			}
			
			if($attempt) {
				//return Redirect::intended('/')->with(array('flash_message' => 'Successfully logged in', 'flash_type' => 'success') );
				//return Redirect::to('admin');
				//Enviar respuesta
				return Response::json(
					array(
						'success' => true,
						'msg'	  => array('Logueado correctamente'),
					)
				);
				//return Redirect::intended('admin');
			}
			
			Auth::user()->logout();
			$msg = array('El nombre de usuario o password no son correctos');
			return Response::json(
				array(
					'success' => false,
					'msg'	  => $msg,
				)
			);
			//return Redirect::back()->with('login_errors', true)->withInput();//agrega variable de sesion temporal login_errors con valor true
			
		}
		else{
			$msg = array('No existe peticion Ajax');
			return Response::json(
				array(
					'success' => false,
					'msg'	  => $msg,
				)
			);
		}
		
		
	}
	
	//Novios Ajax
	public function asesoresLogin()
	{
		$this->beforeFilter('csrf', array('on' => 'post'));
		
		$msg		= array();
		$success 	= false;
		$msgArr 	= false;
		
		if( Request::ajax() ){
			
			$remember=Input::get('remember', 0);
			
			//reglas de validacion
			$rules = array(
				'email' => 'required|max:255',
				'password' => 'required|max:20',
			);
			
			$validation = Validator::make(Input::all(), $rules);
			if( $validation->fails() ){
				//Enviar errores encontrados
				return Response::json(
					array(
						'success' 	=> false,
						'msg'  		=> $validation->getMessageBag()->toArray(),
						'msgArr'	=> true,
					)
				);
				//Enviar a la vista anterior con los errores encontrados
				//return Redirect::back()->withInput()->withErrors($validation);
			}
			
			$user = User::where(function($where){
							$where->where('email', Input::get('email'))
								  ->orWhere('username', Input::get('email'));
						})
						->first();
			
			if(!$user) {
				$attempt = false;
			} else {
				$credentials = array(
					'email' 	=> $user->email,
					'password' 	=> Input::get('password'),
					'status'	=> 'A',//Que este activo
					'nivel_id'	=> '2',//Que su nivel sea Pareja
				);
				
				$attempt = Auth::user()->attempt($credentials, $remember);
			}
					
			if($attempt) {
						
				$success = true;
				$msg = 'Logueado correctamente';
				
				//return Redirect::intended('sitio-fotografos');
			}
			else{
				$msg = 'El nombre de usuario o password no son correctos';
			}
			
			//return Redirect::back()->with('login_errors', true)->withInput();//agrega variable de sesion temporal login_errors con valor true
			
		}
		else{
			$msg = 'No existe peticion Ajax';
		}
		
		if( $success === false ){
			Auth::user()->logout();
		}
		
		return Response::json(
				array(
					'success' => $success,
					'msg'	  => $msg,
					'msgArr'	=> $msgArr,
				)
			);
		
	}
	
	//Invitados Ajax
	public function invitadosLogin()
	{
		$this->beforeFilter('csrf', array('on' => 'post'));
		
		$msg		= array();
		$success 	= false;
		$msgArr 	= false;
		
		if( Request::ajax() ){
		
			Sess::flush();
			Sess::save();
				
			$remember=Input::get('remember', 0);
			
			Input::merge(array('codigo' => abs(Input::get('codigo', 0)) ));
			
			//reglas de validacion
			$rules = array(
				'codigo' => 'required|integer',
			);
			
			/*$messages = array(
				'required'	=> 'El campo :attribute es requerido.',
				'max'		=> 'El campo :attriburte no puede tener m&aacute;s de :max caracteres.',
			);*/
	
			$validation = Validator::make(Input::all(), $rules);
			if( $validation->fails() ){
				//Enviar errores encontrados
				return Response::json(
					array(
						'success' 	=> false,
						'msg'  		=> $validation->getMessageBag()->toArray(),
						'msgArr'	=> true,
					)
				);
				//Enviar a la vista anterior con los errores encontrados
				//return Redirect::back()->withInput()->withErrors($validation);
			}
			
			$user_pareja = UserPareja::where('id', '=', Input::get('codigo',0) )
						->first();
			
			if(!$user_pareja) {
				$msg = "No existe el código de pareja, por favor verifica";
			} else {
				
				Sess::put('loggued_invitado', true);
				Sess::put('user_pareja_id', $user_pareja->id);
				Sess::save();
				$success = true;
				$msg = 'Logueado correctamente';
			}
			
			//return Redirect::back()->with('login_errors', true)->withInput();//agrega variable de sesion temporal login_errors con valor true
			
		}
		else{
			$msg = 'No existe peticion Ajax';
		}
		
		if( $success === false ){
			Auth::user()->logout(); 
			Sess::flush();
			Sess::save();
		}
		
		return Response::json(
				array(
					'success' => $success,
					'msg'	  => $msg,
					'msgArr'	=> $msgArr,
				)
			);
		
	}
	
	//Logout General
	public function logout($url=null)
	{
		Auth::user()->logout(); 
		Sess::flush();
		Sess::save();
		//Redireccionar a index
		
		if( empty($url) ) $url = '/';
		
	 	return Redirect::to($url); 
	}

}

?>