@section('scripts')
	<!--javascript-->
    <script src="{{ asset('scripts/jquery-1.7.1.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('scripts/main.js') }}" type="text/javascript"></script> 
    <script src="{{ asset('scripts/jquery.easytabs.min.js') }}" type="text/javascript"></script>
	<script src="{{ asset('scripts/jquery.hashchange.min.js') }}" type="text/javascript"></script>
	<!--<script src="{{ asset('scripts/jquery.tinycarousel.js') }}" type="text/javascript"></script>-->
	<script type="text/javascript" src="{{ asset('scripts/jquery.jcarousel.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('scripts/carousel.js') }}"></script>
	
	<script type="text/javascript">
	    $(document).ready( function() {
	      $('#tab-container').easytabs();
	    });
    </script>
    
    <script type="text/javascript">
		/*$(document).ready(function()
		{
			$('#slider1').tinycarousel();
		});*/
	</script>
    
@show