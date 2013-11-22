<?php

/**
 * General class with main methods and helper methods
 *
 * @author Gijs Jorissen
 * @since 0.2
 *
 */
class Cuztom
{
	
	/**
	 * Contructs the Cuztom class
	 * Adds actions
	 *
	 * @author Gijs Jorissen
	 * @since 0.3
	 *
	 */
	function __construct()
	{
		add_action('admin_init', array($this, 'register_styles'));
		add_action('admin_print_styles', array($this, 'enqueue_styles'));
		
		add_action('admin_init', array($this, 'register_scripts'));
		add_action('admin_enqueue_scripts', array($this, 'enqueue_scripts'));
	}
	
	
	/**
	 * Registers styles
	 *
	 * @author Gijs Jorissen
	 * @since 0.3
	 *
	 */
	function register_styles()
	{
		wp_register_style('cuztom_css', 
			get_template_directory_uri() . '/admin/assets/css/style.css', 
			false, 
			CUZTOM_VERSION, 
			'screen'
		);
		
		wp_register_style('cuztom_jquery_ui_css', 
			'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/themes/' . CUZTOM_JQUERY_UI_STYLE . '/jquery-ui.css', 
			false, 
			CUZTOM_VERSION, 
			'screen'
		);
	}
	
	
	/**
	 * Enqueues styles
	 *
	 * @author Gijs Jorissen
	 * @since 0.3
	 *
	 */
	function enqueue_styles()
	{
		wp_enqueue_style('cuztom_css');
		wp_enqueue_style('cuztom_jquery_ui_css');
	}
	
	
	/**
	 * Registers scripts
	 *
	 * @author Gijs Jorissen
	 * @since 0.3
	 *
	 */
	function register_scripts()
	{
		wp_register_script('cuztom_js', 
			get_template_directory_uri() . '/admin/assets/js/functions.js', 
			array('jquery', 'jquery-ui-core', 'jquery-ui-datepicker'), 
			CUZTOM_VERSION, 
			true 
		);
	}
	
	
	/**
	 * Enqueues scripts
	 *
	 * @author Gijs Jorissen
	 * @since 0.3
	 *
	 */
	function enqueue_scripts()
	{
		wp_enqueue_script('cuztom_js');
	}
}