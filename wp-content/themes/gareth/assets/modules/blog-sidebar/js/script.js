// sub cat JS functionality on mobile
$(window).ready(function () {

	if(!$('.sub-cat').length){ return; }

	// toggle category nav links
	$('.sub-cat').click(function(e){
	    e.preventDefault();
	    if(!appVars.tablet){return;}
	    if(!$(this).hasClass('open')){
	        $('.sub-cat').removeClass('open');
	        $('.sub-nav > ul').slideUp();
	        $(this).addClass('open');
	        $(this).parent().next().slideDown();
	    }
	    
	})
});