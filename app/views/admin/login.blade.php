<!DOCTYPE html>
<html class="bg-black">
    <head>
        <meta charset="UTF-8">
        <title>Acceso Administraci&oacute;n</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- bootstrap 3.0.2 -->
        <link href="{{ asset('AdminLTE/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="{{ asset('AdminLTE/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="{{ asset('AdminLTE/css/AdminLTE.css') }}" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="bg-black">

        <div class="form-box" id="login-box">
        	
            <div class="header">Acceso Administraci&oacute;n</div>
            <form name="frm_admin_login" id="frm_admin_login" method="post" style="position: relative;">
            	<div class="body bg-gray">
                	<img src="{{ asset('img/logo.png') }}" style="display:block; margin:0 auto; width: 210px; " >
                    <div id="ajax_msg"></div>
                    <div class="form-group">
                        <input type="text" name="email" id="email" class="form-control validate[required]" placeholder="Usuario" value="{{ Input::old('email') }}" data-prompt-position="topLeft" />
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" id="password" class="form-control validate[required]" placeholder="Contrase&ntilde;a" data-prompt-position="topLeft" />
                    </div>          
                    <div class="form-group">
                        <input type="checkbox" name="remember" value="1" />&nbsp;Recordarme
                    </div>
                </div>
                <div class="footer">  
                	<?php /*?><ul style="lcontact-send">
                        <li>&iquest;Olvid&eacute; mi cntrase&ntilde;a?
                        <a id="lightbox_enviar_email" onclick="document.getElementById('resultado_mensaje').innerHTML=''" href=""><span class="minus">Haz clic aqu&iacute;</span></a></li>
                    </ul><?php */?>                                                             
                    <button type="submit" style="background: #00aeef!important;" class="btn btn-default btn-block">Entrar</button>  
                    
                    <?php /*?><p><a id="lightbox_enviar_email" href="#">&iquest;Olvid&eacute; mi contrase&ntilde;a?</a></p><?php */?>
                    
                </div>
                {{ Form::token() }}
            </form>
            
            <?php /*?><div class="margin text-center">
                <span>Sign in using social networks</span>
                <br/>
                <button class="btn bg-light-blue btn-circle"><i class="fa fa-facebook"></i></button>
                <button class="btn bg-aqua btn-circle"><i class="fa fa-twitter"></i></button>
                <button class="btn bg-red btn-circle"><i class="fa fa-google-plus"></i></button>

            </div><?php */?>
        </div>
        
        <div id="div_frm_enviar_email" style="color:#000; display:none;">
            <div style="width:450px; background-color:#FFF; padding:15px;">
                <div id="resultado_mensaje" style="width:100%;"></div>
                <br />
                <form onsubmit="enviarMailPassword(); return false;" name="enviar_email" action="">
                <p style="color:#000; text-align:center; margin:0; font-size:18px;">Ingresa tu email &oacute; nombre de usuario para reenviarte la contrase&ntilde;a</p>
                <p>&nbsp;</p>
                <p style="color:#000;">E-mail &oacute; Nombre de Usuario</p>
                <p>
                <input size="30" type="text" id="email_destino" name="email_destino" value="" />
                
                <input type="button" value="Enviar" onclick="enviarMailPassword(); return false;" />
                </p>
                <p>&nbsp;</p>
        
                </form>
            </div>
    	</div>
        
        <!--jQuery Validation Engine -->
        <link rel="stylesheet" href="{{ asset('js/jQuery-Validation-Engine/css/validationEngine.jquery.css') }}" type="text/css"/>
        <script src="{{ asset('js/jQuery-Validation-Engine/js/jquery-1.8.2.min.js') }}" type="text/javascript">
        </script>
        <script src="{{ asset('js/jQuery-Validation-Engine/js/languages/jquery.validationEngine-es.js') }}" type="text/javascript" charset="utf-8">
        </script>
        <script src="{{ asset('js/jQuery-Validation-Engine/js/jquery.validationEngine.js') }}" type="text/javascript" charset="utf-8">
        </script>
        <script type="text/javascript">
            $(document).ready(function(){
                // binds form submission and fields to the validation engine
                $("#frm_admin_login").validationEngine({
                    autoPositionUpdate:true,
                    focusFirstField : true ,
                    validateNonVisibleFields:false,
                    updatePromptsPosition: true,
                    scroll:false,
                    autoHidePrompt: true,
                    autoHideDelay: 5000,
                    fadeDuration: 400,
                    /*onFieldSuccess: function(){
                        //$("#form_details").validationEngine('updatePromptsPosition');
                    }*/
                    
                });
            });
        </script>
        <!--jQuery Validation Engine -->
        
        <!-- spinner -->
        <script src="{{ asset('js/spin.min.js') }}"></script>
        <script type="text/javascript" language="javascript">
        var optsSpin = {
          lines: 13, // The number of lines to draw
          length: 5, // The length of each line
          width: 4, // The line thickness
          radius: 7, // The radius of the inner circle
          corners: 1, // Corner roundness (0..1)
          rotate: 0, // The rotation offset
          direction: 1, // 1: clockwise, -1: counterclockwise
          color: '#000', // #rgb or #rrggbb
          speed: 1, // Rounds per second
          trail: 60, // Afterglow percentage
          shadow: false, // Whether to render a shadow
          hwaccel: false, // Whether to use hardware acceleration
          className: 'spinner', // The CSS class to assign to the spinner
          zIndex: 2e9, // The z-index (defaults to 2000000000)
          top: '92%', // Top position relative to parent in px
          left: '72.5%' // Left position relative to parent in px
        };
        </script>
        <!-- spinner -->
        
        <!-- Ajax Login -->
        <script type="text/javascript">
        $(document).ready(function() {
            $('#frm_admin_login').submit(function(e){
                e.preventDefault();
                
                if( $("#frm_admin_login").validationEngine('validate') ){
                    $.ajax({
                        type:		'post',
                        cache:		false,
                        dataType:	"json",
                        url:		$(this).attr('action'),
                        data:		$(this).serialize(),
                        beforeSend: function(){
                            //
                            $('#ajax_msg').html('').show();
                            if (typeof spinner != "undefined"){
                                spinner.stop();
                            }
                            spinner = new Spinner(optsSpin).spin(document.getElementById("ajax_msg"));
                            
                        },
                        
                        error: function(){
                            spinner.stop();
                            alert('Error: No se ejecutó login');
                        },
                        
                        success: function(data){
							var salida='';
                            spinner.stop();
                            msg='<ul class="msg">';
                            for( datos in data.msg ){
                                msg+='<li>'+data.msg[datos]+'</li>'
                            }
                            msg+='<ul>';
                            //Limpiar formulario
                            //$(this).reset();
                            
                            //Mostrar mensaje
                            //$('#ajax_msg').show().html(msg);
                            
                            //redirigir
                            if( data.success == true ){
								salida ='<div class="alert alert-info alert-dismissable"><i class="fa fa-info"></i><a class="close" data-dismiss="alert" aria-hidden="true">&times;</a>'+msg+'</div>';
								
								$('#ajax_msg').css({opacity: 1.0, visibility: "visible"}).animate({opacity: 0}, 400, function() {
									//spinner.stop();
									// Animation complete.
									$(this).html(function(){
										$(this).css({opacity: 0, visibility: "visible"}).animate({opacity: 1},400);
										return salida;
									}).promise().done(function(){
										window.location='{{ url("admin") }}';
									});
								});
								
                            }
							else{
								salida ='<div class="alert alert-danger alert-dismissable"><i class="fa fa-ban"></i><a type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</a>'+msg+'</div>';
								
								
								$('#ajax_msg').css({opacity: 1.0, visibility: "visible"}).animate({opacity: 0}, 400, function() {
									//spinner.stop();
									// Animation complete.
									$(this).html(function(){
										$(this).css({opacity: 0, visibility: "visible"}).animate({opacity: 1},400);
										return salida;
									})/*.promise().done(function(){
										desvanecer();
									})*/;
								});
								
								
								
							}
                            
                        },
                        
                    });
                }
            });
        });		
        </script>
        <!-- Ajax Login -->
        
        <script type="text/javascript" src="{{ asset('js/jquery.lightbox_me.js') }}"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                $('#lightbox_enviar_email').click(function(e) {
                    $('#div_frm_enviar_email').lightbox_me({
                        centered: true, 
                        onLoad: function() { 
                            $('#div_frm_enviar_email').find('input:first').focus()
                        }
                    });
                    e.preventDefault();
                });
            });
        </script>
    
        <!-- desvanecer div -->
        <script type="text/javascript">    
        $(document).ready(function() {
        setTimeout(function() {
            $(".desvanecer").fadeOut(1500);
        },10000);
        });
        
        function desvanecer(){
            setTimeout(function() {
                    $(".desvanecer").fadeOut(1500);
                },10000);
        }    
        </script>
    
        <script type="text/javascript">
            function focusUsuario(){
                $('#email').focus();
            }
            setTimeout("focusUsuario();",700);
        </script>      

		
        <?php /*?><!-- jQuery 2.0.2 -->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script><?php */?>
        <!-- Bootstrap -->
        <script src="{{ asset('AdminLTE/js/bootstrap.min.js') }}" type="text/javascript"></script>  
    </body>
</html>