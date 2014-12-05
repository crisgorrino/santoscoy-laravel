@section('scripts')
	<!-- jQuery 2.0.2 -->
	<?php /*?><script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script><?php */?>
    <script src="{{ asset('AdminLTE/js/jqueryAlerts/jquery-1.8.2.js') }}" type="text/javascript"></script>
    <!-- jQuery UI 1.10.3 -->
    <script src="{{ asset('AdminLTE/js/jquery-ui-1.10.3.min.js') }}" type="text/javascript"></script>
    <!-- Bootstrap -->
    <script src="{{ asset('AdminLTE/js/bootstrap.min.js') }}" type="text/javascript"></script>
    <?php /*?><!-- Morris.js charts -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="{{ asset('AdminLTE/js/plugins/morris/morris.min.js') }}" type="text/javascript"></script>
    <!-- Sparkline -->
    <script src="{{ asset('AdminLTE/js/plugins/sparkline/jquery.sparkline.min.js') }}" type="text/javascript"></script>
    <!-- jvectormap -->
    <script src="{{ asset('AdminLTE/js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('AdminLTE/js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}" type="text/javascript"></script>
    <!-- fullCalendar -->
    <script src="{{ asset('AdminLTE/js/plugins/fullcalendar/fullcalendar.min.js') }}" type="text/javascript"></script>
    <!-- jQuery Knob Chart -->
    <script src="{{ asset('AdminLTE/js/plugins/jqueryKnob/jquery.knob.js') }}" type="text/javascript"></script>
    <!-- daterangepicker -->
    <script src="{{ asset('AdminLTE/js/plugins/daterangepicker/daterangepicker.js') }}" type="text/javascript"></script>
    <!-- Bootstrap WYSIHTML5 -->
    <script src="{{ asset('AdminLTE/js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}" type="text/javascript"></script>
    <!-- iCheck -->
    <script src="{{ asset('AdminLTE/js/plugins/iCheck/icheck.min.js') }}" type="text/javascript"></script><?php */?>

    <!-- AdminLTE App -->
    <script src="{{ asset('AdminLTE/js/AdminLTE/app.js') }}" type="text/javascript"></script>
    
    <?php /*?><!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{ asset('AdminLTE/js/AdminLTE/dashboard.js') }}" type="text/javascript"></script>     
    
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('AdminLTE/js/AdminLTE/demo.js') }}" type="text/javascript"></script><?php */?>
    
    <!-- desvanecer div -->
	<script type="text/javascript">    
    $(document).ready(function() {
    setTimeout(function() {
		
		$('.desvanecer').css({opacity: 1.0, visibility: "visible"}).animate({opacity: 0}, 1000, function() {
			//spinner.stop();
			// Animation complete.
			$(this).slideUp(500);
			
		});
		
    },8000);
    });
    
    function desvanecer(){
        setTimeout(function() {
            $('.desvanecer').css({opacity: 1.0, visibility: "visible"}).animate({opacity: 0}, 1000, function() {
				//spinner.stop();
				// Animation complete.
				$(this).slideUp(500);
				
			});
        },8000);
    }    
    </script>

    <script type="text/javascript">
        function focusUsuario(){
            $('#email').focus();
        }
        setTimeout("focusUsuario();",700);
    </script>
@show