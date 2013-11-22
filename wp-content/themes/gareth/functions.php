<?php

define('APPLICATION_PATH', get_theme_root() . '/tyrrell/application');
define('LIBRARY_PATH', get_theme_root() . '/tyrrell/library');

set_include_path(LIBRARY_PATH);

require_once(APPLICATION_PATH . '/bootstrap.php');

// Start the application
$bootstrap = new Bootstrap;

/*
 * Functiion to get the content and wrap the more content in a custom div 
 */
function getContentMoreFiltered($content){

	$content = apply_filters('the_content', $content);
	$parts = explode('<p><!--more--></p>', $content);

	echo $parts[0];

	if($parts[1]){
		echo '<div class="more-content">';
		echo $parts[1];
		echo '</div>';
		echo '<a href="#" class="more-link">Read more<span class="arrow-down"></span></a>';
	}

}

/*
 * Posts to Posts connections
 */
function my_connection_types() {

	p2p_register_connection_type( 
		array(
			'name' => 'pod_to_page',
			'from' => 'pod',
			'to' => 'page',
			'sortable' => 'any'
		)
	);

	p2p_register_connection_type( 
		array(
			'name' => 'testimonial_to_page',
			'from' => 'testimonial',
			'to' => 'page',
			'sortable' => 'any'
		)
	);
	
}

add_action( 'p2p_init', 'my_connection_types' );
