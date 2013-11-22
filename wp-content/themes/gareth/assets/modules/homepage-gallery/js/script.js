$(window).ready(function(){

	if(!$('.homepage-gallery').length){return;}

	$('.homepage-gallery li').fadeOut();
		
	// start the Gallery
	$('.homepage-gallery').flexslider({
                selector:".slides li",
                animation:"fade",
                animationSpeed: 1000,
                nextText:'',
                prevText:'',
                controlNav:true,
                controlsContainer: '.flex-controlls-container',
                start: function(){
        	       $('.homepage-gallery li').eq(0).fadeIn();
                },
                after: function(){
                	$('.flex-active-slide').fadeIn();
                }
	});

        $('.flex-prev').addClass('arrow-left icon-play');
        $('.flex-next').addClass('arrow-right icon-play')
});