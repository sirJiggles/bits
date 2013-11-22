/* JS FOR THE TEAM MODULE */

$(window).ready(function () {

	if(!$('.team-listing').length){ return; }

	// open the first one (if not mobile)
	if(!(appVars.mobile)){
		var firstArticle = $('.team-listing').eq(0).find('article').eq(0);
		$(firstArticle).addClass('open').find('.bio-wrapper').slideDown();
		$(firstArticle).find('.more').text('Close biography').attr('title', 'Close biography');
	}

	// clicking the more links
	$('.more').click(function(e){
	    e.preventDefault();

	    var article = $(this).parent().parent();

	    if($(article).hasClass('open')){
	    	// just close and exit
	    	$(article).removeClass('open').find('.bio-wrapper').slideUp();
	    	$(this).text('Read biography').attr('title', 'Read biography');
	    	return;
	    }

	    // do the slide .. everyone is talking about it!
	    $('.team-listing article').removeClass('open').find('.bio-wrapper').slideUp();
	    $(article).addClass('open').find('.bio-wrapper').slideDown();

	     // change the text
	    $('.team-listing article .more').text('Read biography').attr('title', 'Read biography');
	    $(this).text('Close biography').attr('title', 'Close biography');
	    
	})
});