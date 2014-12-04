<?php

class RecuperarPassController extends BaseController {
	
	//Recuperar password
	public function postIndex()
	{
		
		$this->beforeFilter('csrf', array('on' => 'post'));
		
		$msg='';
		$success = false;
		
		if( Request::ajax() ){
			
			$email = Input::get('email', 0);
			
			//Primero verificar que exista correo
			$user = User::with('nivel')->where('email', '=', $email)->first();
			
			if( !$user ){
				$msg.= 'No existe ese email en nuestro sistema.';
			}
			else{
				$password_generated = str_random(20);
				$user->password = Hash::make( $password_generated );
				
				if( $user->save() ){
					
					$data = array(
						'msg' 		=> 'Nueva Contraseña generada',
						'nivel'		=> $user->nivel->tipo,
						'nombre'	=> $user->nombre.' '.$user->am.' '.$user->am,
						'email'		=> $user->email,
						'password'	=> $password_generated,
					);
					
					Mail::send('emails.user-pass', $data, function($message)use($email) {
						$message->to( $email )->subject('Nueva contraseña generada');
					});
					$msg.= 'Email Enviado.';
					
					$success = true;
				}
				else{
					$msg.= 'Email no enviado, intenta nuevamente.';
				}
				
			}
			
		}
		else{
			$msg = 'No existe peticion Ajax';
		}
		
		return Response::json(
				array(
					'success' => $success,
					'msg'	  => '<p>'.$msg.'</p>',
				)
			);
		
		
	}
	

}

?>