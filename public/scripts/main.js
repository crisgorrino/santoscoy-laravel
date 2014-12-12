
$(document).ready(function(){
	//hide menu divs
	$('.taller-cont').hide();
	$('.editorial-cont').hide();
	$('.contact-cont').hide();
	$('.busqueda-cont').hide()
	
	var time = 1050;
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
		scrollTop();
		$('.section-pages-cont').children('div').slideUp(time);
		
		//$('.section-pages-cont').children('div').siblings().hide();
		
	});
	
	//contacto toggle
	$('.contacto').click(function(e){
		e.preventDefault();
		scrollTop();
		$('.contact-cont').siblings().slideUp(time).promise().done(function(){
			$('.contact-cont').slideToggle(time);
		});
		
		//$('.contact-cont').siblings().hide();
	});
	
	//busqueda toggle
	$('.busqueda').click(function(e){
		e.preventDefault();
		scrollTop();
		$('.busqueda-cont').siblings().slideUp(time).promise().done(function(){
			$('.busqueda-cont').slideToggle(time);			
		});
	});
	
	//taller toggle
	$('.taller').click(function(e){
		e.preventDefault();
		scrollTop();
		$('.taller-cont').siblings().slideUp(time).promise().done(function(){
			$('.taller-cont').slideToggle(time);
			
		});
	});
	
	//taller toggle
	$('.editorial').click(function(e){
		e.preventDefault();
		scrollTop();
		$('.editorial-cont').siblings().slideUp(time).promise().done(function(){
			$('.editorial-cont').slideToggle(time);			
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

function scrollTop(){
	$('html, body').animate({
		scrollTop: $("body").offset().top
	}, 1000);
}