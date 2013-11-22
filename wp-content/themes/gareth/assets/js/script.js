
/*
 * Main javascript file
 * 
 * require any libraries using juicer
 * 
 * @depends vendor/jquery-1.8.2.min.js
 * @depends vendor/hammer.min.js
 * @depends vendor/lightbox-2.6.min.js
 * @depends app-functions.js
 * @depends vendor/jquery.flexslider-min.js
 * @depends vendor/socialite.min.js
 * @depends ../modules/homepage-gallery/js/script.js
 * @depends ../modules/google-map/js/script.js
 * @depends ../navigation/js/script.js
 * @depends ../modules/blog-listing/js/script.js
 * @depends ../modules/blog-sidebar/js/script.js
 * @depends ../modules/team-listing/js/script.js
 */


$(window).ready(function () {
    
     // Generic resize function
    $(window).resize(function(){
        clearTimeout(appVars.resizeTimer);
        appVars.resizeTimer = setTimeout(resizeWindowCallback, 500);
    });

    // tooltip hovering functions (functions are in ... functions file)
    $('.tip').hover(function(){
        showTip(this);
        return false;
    }, function(){
        hideTip();
        return false;
    });


    $('a.back-to-top').click(function(e){
        e.preventDefault();
        $(jQuery.browser.webkit ? "body": "html").animate({ scrollTop: 0 }, "slow");
    })

    $('.js-submit').click(function(e){
        e.preventDefault();
        $(this).parent().find('input[type="submit"]').click();
    })

    if(appVars.mobile){
        $('table').each(function(key, val){
            convertTableToList(val);
        })
        appVars.tablesSwapped = true;
    }

});

$(window).load(function(){

    // External link class JS
    externalLinks();
});