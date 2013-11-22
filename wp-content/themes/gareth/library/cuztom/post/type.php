<?php

/**
 * Post Type class used to register post types
 * Can call add_taxonomy and add_meta_box to call the associated classes
 * Method chaining is possible
 *
 * @author Gijs jorissen
 * @since 0.1
 *
 */
class Cuztom_Post_Type
{
	public $post_type_name;
	public $post_type_args;
	public $post_type_labels;
	
	
	/**
	 * Construct a new Custom Post Type
	 *
	 * @param string $name
	 * @param array $args
	 * @param array $labels
	 *
	 * @author Gijs Jorissen
	 * @since 0.1
	 *
	 */
	public function __construct($name, $args = array(), $labels = array())
	{
		if (!empty($name))
		{
			// Set some important variables
			$this->post_type_name		= Inflector::uglify($name);
			$this->post_type_args 		= $args;
			$this->post_type_labels 	= $labels;

			// Add action to register the post type, if the post type doesnt exist
			if (!post_type_exists($this->post_type_name))
			{
				add_action('init', array(&$this, 'register_post_type'));
			}
		}
	}
	
	
	/**
	 * Register the Post Type
	 *
	 * @author Gijs Jorissen
	 * @since 0.1
	 *
	 */
	public function register_post_type()
	{		
		// Capitilize the words and make it plural
		$name 		= Inflector::beautify($this->post_type_name);
		$plural 	= Inflector::pluralize($name);

		// We set the default labels based on the post type name and plural. 
		// We overwrite them with the given labels.
		$labels = array_merge(

			// Default
			array(
				'name' 					=> _x($plural, 'post type general name'),
				'singular_name' 		=> _x($name, 'post type singular name'),
				'add_new' 				=> _x('Add New', strtolower($name)),
				'add_new_item' 			=> __('Add New ' . $name),
				'edit_item' 			=> __('Edit ' . $name),
				'new_item' 				=> __('New ' . $name),
				'all_items' 			=> __('All ' . $plural),
				'view_item' 			=> __('View ' . $name),
				'search_items' 			=> __('Search ' . $plural),
				'not_found' 			=> __('No ' . strtolower($plural) . ' found'),
				'not_found_in_trash' 	=> __('No ' . strtolower($plural) . ' found in Trash'), 
				'parent_item_colon' 	=> '',
				'menu_name' 			=> $plural
			),

			// Given labels
			$this->post_type_labels

		);

		// Same principle as the labels. We set some default and overwite them with the given arguments.
		$args = array_merge(

			// Default
			array(
				'label' 				=> $plural,
				'labels' 				=> $labels,
				'public' 				=> true,
				'show_ui' 				=> true,
				'supports' 				=> array('title', 'editor', 'thumbnail'),
				'show_in_nav_menus' 	=> true,
				'exclude_from_search'	=> true,
				'_builtin' 				=> false,
			),

			// Given args
			$this->post_type_args

		);

		// Register the post type
		register_post_type($this->post_type_name, $args);
	}
	
	
	/**
	 * Add a taxonomy to the Post Type
	 *
	 * @param string $name
	 * @param array $args
	 * @param array $labels
	 *
	 * @author Gijs Jorissen
	 * @since 0.1
	 *
	 */
	public function add_taxonomy($name, $args = array(), $labels = array())
	{
		// Call Cuztom_Post_Taxonomy with this post type name as second parameter
		$taxonomy = new Cuztom_Post_Taxonomy($name, $this->post_type_name, $args, $labels);
		
		// For method chaining
		return $this;
	}
	
	
	/**
	 * Add post meta box to the Post Type
	 *
	 * @param string $title
	 * @param array $fields
	 * @param string $context
	 * @param string $priority
	 *
	 * @author Gijs Jorissen
	 * @since 0.1
	 *
	 */
	public function add_meta_box($title, $fields = array(), $context = 'normal', $priority = 'default')
	{
		$meta_box = new Cuztom_Post_Meta($title, $fields, $this->post_type_name, $context, $priority);
		
		// For method chaining
		return $this;
	}	
}