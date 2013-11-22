$('.nav-controls a').click(function(event){
	event.preventDefault();
	$(jQuery.browser.webkit ? "body": "html").animate({ scrollTop: 0 }, "slow");
	$('.main-nav-standard ul').toggleClass('open');
});