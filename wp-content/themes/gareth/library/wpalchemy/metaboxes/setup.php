<?php

include_once LIBRARY_PATH . '/wpalchemy/meta-box.php';
include_once LIBRARY_PATH . '/wpalchemy/media-access.php';
 
// global styles for the meta boxes
if (is_admin()) wp_enqueue_style('wpalchemy-metabox', get_stylesheet_directory_uri() . '/library/wpalchemy/metaboxes/meta.css');

global $wpalchemy_media_access;

$wpalchemy_media_access = new WPAlchemy_MediaAccess();

/* eof */