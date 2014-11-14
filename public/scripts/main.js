
$(document).ready(function(){
	//hide menu divs
	$('.taller-cont').hide();
	$('.editorial-cont').hide();
	$('.contact-cont').hide();
	$('.busqueda-cont').hide()
	
	
	//general close button
	$('.close').click(function(){
		$(this).parent().slideUp('slow');
	})
	
	
	//busq close button
	$('.close-busq').click(function(){
		$('.busqueda-cont').slideUp('slow');
	})
	
	
	//contacto toggle
	$('.contacto').click(function(e){
		e.preventDefault();
		$('.contact-cont').slideToggle('slow');
		$('.contact-cont').siblings().hide();
	});
	
	//busqueda toggle
	$('.busqueda').click(function(e){
		e.preventDefault();
		$('.busqueda-cont').slideToggle('slow');
		$('.busqueda-cont').siblings().hide();
	});
	
	//taller toggle
	$('.taller').click(function(e){
		e.preventDefault();
		$('.taller-cont').slideToggle('slow');
		$('.taller-cont').siblings().hide();
	});
	
	//taller toggle
	$('.editorial').click(function(e){
		e.preventDefault();
		$('.editorial-cont').slideToggle('slow');
		$('.editorial-cont').siblings().hide();
	});



	//taller toggle para imagenes
	//preparacion
	/*$('.preparacion-btn').click(function(e){
		e.preventDefault();
		$('#preparacion').slideToggle('slow');
		$('#preparacion').siblings().hide();
	});
	
	//taller toggle para imagenes
	//preparacion
	$('.incubacion-btn').click(function(e){
		e.preventDefault();
		$('#incubacion').slideToggle('slow');
		$('#incubacion').siblings().hide();
	});
	*/

	$('.cruz p').hide();
	
	$('.cruz').hover(function(){
		$(this).children().slideToggle();
	});
	
});