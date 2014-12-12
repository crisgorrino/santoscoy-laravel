
$(document).ready(function(){
	//hide menu divs
	$('.taller-cont').hide();
	$('.editorial-cont').hide();
	$('.contact-cont').hide();
	$('.busqueda-cont').hide()
	
	var time = 1250;
	//general close button
	$('.close').click(function(){
		$(this).parent().slideUp('slow');
	})
	
	
	//busq close button
	$('.close-busq').click(function(){
		$('.busqueda-cont').slideUp('slow');
	})
	
	//proyectos toggle
	$('.proyectos').click(function(e){
		e.preventDefault();
		
		$('.section-pages-cont').children('div').slideUp(time);
		//$('.section-pages-cont').children('div').siblings().hide();
		
	});
	
	//contacto toggle
	$('.contacto').click(function(e){
		e.preventDefault();
		$('.contact-cont').siblings().slideUp(time).promise().done(function(){
			$('.contact-cont').slideDown(time);
		});
		
		//$('.contact-cont').siblings().hide();
	});
	
	//busqueda toggle
	$('.busqueda').click(function(e){
		e.preventDefault();
		$('.busqueda-cont').siblings().slideUp(time).promise().done(function(){
			$('.busqueda-cont').slideDown(time);
		});
	});
	
	//taller toggle
	$('.taller').click(function(e){
		e.preventDefault();
		$('.taller-cont').siblings().slideUp(time).promise().done(function(){
			$('.taller-cont').slideDown(time);
		});
	});
	
	//taller toggle
	$('.editorial').click(function(e){
		e.preventDefault();
		$('.editorial-cont').siblings().slideUp(1250).promise().done(function(){
			$('.editorial-cont').slideDown(1250);
		});
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