<?php

class UserRegistroController extends BaseController {
	
	public function getIndex()
	{
		return Redirect::to('/');
	}
	
	public function postIndex()
	{
		
		//reglas de validacion
		$rules = array(
			'nombre'	=> 'required|max:100',
			'am'		=> 'required|max:100',
			'ap'		=> 'max:100',
			'email' 	=> 'unique:users|required|email|max:255',
			'password' 	=> 'required|min:6|max:20|confirmed',
		);
		
		/*$messages = array(
			'required'	=> 'El campo :attribute es requerido.',
			'max'		=> 'El campo :attriburte no puede tener m&aacute;s de :max caracteres.',
			'min'		=> 'El campo :attribute no puede tener menos de :min caracteres.',
			'email'		=> 'El campo :attribute no es v&aacute;lido.',
			'confirmed'	=> 'El campo :attribute de confirmaci&oacute;n no coincide.',
			'unique'	=> 'El campo :attribute ya existe.'
		);*/

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
			
		

		$user = new User;//instancia de modelo clase User.php
		
		$nivel_id = 2;
		
		$user->nombre	= Input::get('nombre');
		$user->am 		= Input::get('am');
		$user->ap 		= Input::get('ap');
		$user->email 	= Input::get('email');
		$user->password = Hash::make( Input::get('password') );
		$user->nivel_id	= $nivel_id;
		$user->status	= 'A';
		
		
		if($user->save()){
			
			$remember=null;
			$userdata = array(
				'email' => $user->email,
				'password' => Input::get('password'),
				'status'=>'A',//Que este activo
				'nivel_id'=>$nivel_id,//Que su nivel sea cliente registrado
			);
			
			$attempt = Auth::user()->attempt($userdata, $remember);
			
			if($attempt) {
				
				//Insertar Registro de Session
				$session_log = new UserSessionLog; //instancia del modelo de la clase Producto
				$session_log->user_id = $user->id;
				if($session_log->save()){
					//Registro de Session guardado correctamente
				}
				
				
				//return Redirect::intended('/')->with(array('flash_message' => 'Successfully logged in', 'flash_type' => 'success') );
				$miUsuario = Auth::user()->get();
				//return Redirect::to('admin');
				//return Redirect::intended('sitio-fotografos')->with('nueva_cuenta', true);
				//Datos plantilla ticket
				$data = array( 
					'msg'			=> 'Nuevo Registro',
					'fecha'			=> $miUsuario->created_at,
					'nombre'		=> $miUsuario->nombre.' '.$miUsuario->ap.' '.$miUsuario->am, 
					'email'			=> $miUsuario->email,
					'status'		=> 'Activo', 
					'password'	=> Input::get('password')
					);
				
				//Enviar Email registro
				$emailEnviado=true;
				if(
				Mail::send('emails.registro', $data, function($message) use($miUsuario)
				{
					
					$usersAdmin = DB::table('users')->where('nivel_id', '=', '1')->get();
					
					$sendmail = DB::table('sendmail')->get();
					
					$arrU=array();
					foreach ($usersAdmin as $u)
					{
						$arrU[]=$u->email;
					}
					
					foreach ($sendmail as $s)
					{
						//$message->to($s->email,$s->nombre);
						$arrU[]=$s->email;
					}
					
					//enviar al cliente
					$message->to($miUsuario->email, $miUsuario->nombre.' '.$miUsuario->ap.' '.$miUsuario->am);
					
					$message->bcc( $arrU )->subject($this->proyectName.' - Nuevo Registro: '.$miUsuario->nombre.' '.$miUsuario->ap.' '.$miUsuario->am);
					
				})
				){
					//$emailEnviado=true;
				}
				
				
				$html='';
				ob_start();
				?>
                <div class="left session-user">
                    <p>Bienvenid@ <?php echo $miUsuario->nombre.' '.$miUsuario->ap.' '.$miUsuario->am; ?></p>
                    <p>Actualmente cuentas con <span class="ptos">0 puntos</span></p>
                    <?php /*?><p>(Vigencia hasta el 30 de Agosto del 2014)</p><?php */?>
                    <a class="btn_red right" href="<?php echo url('logout'); ?>">SALIR</a>
                </div>
				<?php
				$html = ob_get_clean();
				
				return Response::json(
					array(
						'success' => true,
						'msg'	  => array('<p>Cuenta creada correctamente</p>'),
						'html'	  => $html,
					)
				);
				
			}
			
			
		}
		
		return Response::json(
				array(
					'success' => false,
					'msg'	  => array('Registro no Guardado &oacute; ya existe el usuario.'),
				)
			);
		
	}

}
