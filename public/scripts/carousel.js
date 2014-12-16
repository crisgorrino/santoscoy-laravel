(function($) {
    $(function() {
        //
        //Carousel initialization
        ///
        $('.jcarousel')
            .jcarousel({
                // Options go here
				center: true
            });

        //
        //Prev control initialization
        ///
        $('.jcarousel-control-prev')
            .on('jcarouselcontrol:active', function() {
                $(this).removeClass('inactive');
            })
            .on('jcarouselcontrol:inactive', function() {
                $(this).addClass('inactive');
            })
            .jcarouselControl({
                // Options go here
                target: '-=1'
            });

        //
        //Next control initialization
        ///
        $('.jcarousel-control-next')
            .on('jcarouselcontrol:active', function() {
                $(this).removeClass('inactive');
            })
            .on('jcarouselcontrol:inactive', function() {
                $(this).addClass('inactive');
            })
            .jcarouselControl({
                // Options go here
                target: '+=1'
            });

        //
        //Pagination initialization
        //
        $('.jcarousel-pagination')
            .on('jcarouselpagination:active', 'a', function() {
                $(this).addClass('active');
            })
            .on('jcarouselpagination:inactive', 'a', function() {
                $(this).removeClass('active');
            })
            .jcarouselPagination({
                // Options go here
            });
			
		
    });
})(jQuery);

/*(function($) {
    // This is the connector function.
    // It connects one item from the navigation carousel to one item from the
    // stage carousel.
    // The default behaviour is, to connect items with the same index from both
    // carousels. This might _not_ work with circular carousels!
    var connector = function(itemNavigation, carouselStage) {
        return carouselStage.jcarousel('items').eq(itemNavigation.index());
    };

    $(function() {
        // Setup the carousels. Adjust the options for both carousels here.
        var carouselStage      = $('.modal-detalle .jcarousel').jcarousel();
        var carouselNavigation = $('.carousel-navigation').jcarousel();

        // We loop through the items of the navigation carousel and set it up
        // as a control for an item from the stage carousel.
        carouselNavigation.jcarousel('items').each(function() {
            var item = $(this);
			
            // This is where we actually connect to items.
            var target = connector(item, carouselStage);

            item
                .on('jcarouselcontrol:active', function() {
                    carouselNavigation.jcarousel('scrollIntoView', this);
                    item.addClass('active');
                })
                .on('jcarouselcontrol:inactive', function() {
                    item.removeClass('active');
                })
                .jcarouselControl({
                    target: target,
                    carousel: carouselStage
                });
        });
		
		var carouselStage      = $('.slide-principal .jcarousel').jcarousel();
        var carouselNavigation = $('.carousel-navigation-modal').jcarousel();

        // We loop through the items of the navigation carousel and set it up
        // as a control for an item from the stage carousel.
        carouselNavigation.jcarousel('items').each(function() {
            var item = $(this);
			
            // This is where we actually connect to items.
            var target = connector(item, carouselStage);

            item
                .on('jcarouselcontrol:active', function() {
                    carouselNavigation.jcarousel('scrollIntoView', this);
                    item.addClass('active');
                })
                .on('jcarouselcontrol:inactive', function() {
                    item.removeClass('active');
                })
                .jcarouselControl({
                    target: target,
                    carousel: carouselStage
                });
        });

        // Setup controls for the stage carousel
        $('.prev-stage')
            .on('jcarouselcontrol:inactive', function() {
                $(this).addClass('inactive');
            })
            .on('jcarouselcontrol:active', function() {
                $(this).removeClass('inactive');
            })
            .jcarouselControl({
                target: '-=1'
            });

        $('.next-stage')
            .on('jcarouselcontrol:inactive', function() {
                $(this).addClass('inactive');
            })
            .on('jcarouselcontrol:active', function() {
                $(this).removeClass('inactive');
            })
            .jcarouselControl({
                target: '+=1'
            });

        // Setup controls for the navigation carousel
        $('.jcarousel-control-prev')
            .on('jcarouselcontrol:inactive', function() {
                $(this).addClass('inactive');
            })
            .on('jcarouselcontrol:active', function() {
                $(this).removeClass('inactive');
            })
            .jcarouselControl({
                target: '-=1'
            });

        $('.jcarousel-control-next')
            .on('jcarouselcontrol:inactive', function() {
                $(this).addClass('inactive');
            })
            .on('jcarouselcontrol:active', function() {
                $(this).removeClass('inactive');
            })
            .jcarouselControl({
                target: '+=1'
            });
    });
})(jQuery);*/

$(document).ready(function(e) {
    $('body').on('click', '.modal-detalle .jcarousel-control-prev', function(){
		var current = $('.jcarousel').jcarousel('target').index();
		
		$('.slide-principal .jcarousel').jcarousel('scroll', current);
		
		var elemento = $(".hover-editorial[data-pos='"+(current+1)+"']");
		var datos = elemento.data('editorial');
		$('.hover-editorial').children('span').removeClass('hide-num');
		$('.hover-editorial').children('img').remove();
		
		elemento.children('span').addClass('hide-num');
		elemento.append('<img src="'+datos.path+'thumb_'+datos.archivo+'" alt="">');
		
	});
	
	$('body').on('click', '.modal-detalle .jcarousel-control-next', function(){
		var current = $('.jcarousel').jcarousel('target').index();
		
		$('.slide-principal .jcarousel').jcarousel('scroll', current);
		
		var elemento = $(".hover-editorial[data-pos='"+(current+1)+"']");
		var datos = elemento.data('editorial');
		$('.hover-editorial').children('span').removeClass('hide-num');
		$('.hover-editorial').children('img').remove();
		
		elemento.children('span').addClass('hide-num');
		elemento.append('<img src="'+datos.path+'thumb_'+datos.archivo+'" alt="">');
		
	});
});