// - test svn
function slideSwitch() {
    var $active = jQuery('#art-slideshow DIV.active');

    if ( $active.length == 0 ) $active = jQuery('#art-slideshow DIV:last');

    // use this to pull the images in the order they appear in the markup
    var $next =  $active.next().length ? $active.next()
        : jQuery('#art-slideshow DIV:first');

    // uncomment the 3 lines below to pull the images in random order
    
    // var $sibs  = $active.siblings();
    // var rndNum = Math.floor(Math.random() * $sibs.length );
    // var $next  = $( $sibs[ rndNum ] );


    $active.addClass('last-active');

    $next.css({opacity: 0.0})
        .addClass('active')
        .animate({opacity: 1.0}, 3000, function() {
            $active.removeClass('active last-active');
        });
}


function blinkarrow(){

var $buttonOpacity = jQuery('#action-button');

	if ($buttonOpacity.hasClass('blinkon')){
	
	jQuery('#action-button').animate({opacity: 0.0}, 500);
	$buttonOpacity.removeClass('blinkon');
	$buttonOpacity.addClass('blinkoff');
	}
	
	else
	
	{
	jQuery('#action-button').animate({opacity: 1.0}, 500);
	$buttonOpacity.removeClass('blinkoff');
	$buttonOpacity.addClass('blinkon');
	}
	
	
	
}


jQuery(function() {


	var $active = jQuery('#art-slideshow IMG.active');
							
	$active.animate({opacity: 1.0}, 1000);

    setInterval( "slideSwitch()", 5000 );
    
      
    var $slidepane = jQuery('#leader');
    $slidepane.animate({opacity:"1.0"}, 1500).slideUp("slow").delay(1500);
    
    jQuery('#action-button').click(function () {
	if ($slidepane.is(":hidden")) {
	$slidepane.slideDown("slow");
	jQuery('#action-button').addClass('collapse-arrow');
	jQuery('#action-button').removeClass('expand-arrow');
	} else {
	jQuery('#action-button').addClass('expand-arrow');
	jQuery('#action-button').removeClass('collapse-arrow');
	$slidepane.slideUp("slow");
	}
	});
	
	setInterval( "blinkarrow()", 1000 );
	
	

    
    
});
