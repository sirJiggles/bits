<?php

class Bootstrap
{
	public function __construct()
	{
		foreach (get_class_methods($this) as $method) {
			if (substr($method, 0, 5) == '_init') {
				call_user_func(array($this, $method));
			}
		}
	}

	protected function _init_helpers()
	{
		require_once(LIBRARY_PATH . '/site.php');
		require_once(LIBRARY_PATH . '/uri.php');
		require_once(LIBRARY_PATH . '/inflector.php');
		require_once(LIBRARY_PATH . '/post.php');
		require_once(LIBRARY_PATH . '/taxonomy.php');
		require_once(LIBRARY_PATH . '/media.php');
	}

	protected function _init_walkers()
	{
		require_once(APPLICATION_PATH . '/walker/primary.php');
	}

	protected function _init_image_sizes()
	{
		add_theme_support('post-thumbnails');

		// custom image sizes for the theme
		add_image_size('homepage_banner', 938, 356, true);
		add_image_size('news-feature', 242, 200, true);
		add_image_size('team-profile', 221, 156, true);
		add_image_size('testimonial', 238, 202, true);
		add_image_size('service', 300, 194, true);
	}

	protected function _init_custom_taxonomies(){


		// custom categories for the team members as this is used for the nav on the team archive page
		register_taxonomy('job_category', 'team', array(
													"hierarchical" => true,
													"label" => "Job Category",
													'update_count_callback' => '_update_post_term_count',
													'query_var' => true,
													'public' => true,
													'show_ui' => true,
													'show_tagcloud' => true,
													'_builtin' => false,
													'show_in_nav_menus' => false));
	}

	protected function _init_custom_post_types()
	{


		require_once(LIBRARY_PATH . '/cuztom.php');

		require_once(LIBRARY_PATH . '/cuztom/post/type.php');
		require_once(LIBRARY_PATH . '/cuztom/post/taxonomy.php');

		require_once(LIBRARY_PATH . '/cuztom/post/meta.php');
		require_once(LIBRARY_PATH . '/cuztom/post/meta/field.php');

		define('CUZTOM_VERSION', '0.4');
		if (!defined('CUZTOM_JQUERY_UI_STYLE')) define('CUZTOM_JQUERY_UI_STYLE', 'cupertino');

		$cuztom = new Cuztom;

		$homepageSlides = new Cuztom_Post_Type('Homepage Slide');

		$testimonials = new Cuztom_Post_Type('Testimonial');

		$services = new Cuztom_Post_Type('Service');

		$pods = new Cuztom_Post_Type('Pod', array(
			'hierarchical'  => false,
            'has_archive'   => true,
            'supports'      => array(
                'title',
                'thumbnail'
            )
		));

		$teams = new Cuztom_Post_Type('Team', array(
			'hierarchical'  => false,
            'has_archive'   => true,
            'supports'      => array(
                'title',
                'editor',
                'thumbnail'
            ),
            'rewrite'       => array(
                'with_front'    => true,
                'slug'          => 'team',
            ),
		));
	}

	protected function _init_custom_post_meta()
	{
		require_once(LIBRARY_PATH . '/wpalchemy/metaboxes/setup.php');

		$wpalchemy_media_access = new WPAlchemy_MediaAccess();

		global $homepage_slide;
		global $pod;
		global $testimonial;
		global $team;
		global $service;

		$homepage_slide = new WPAlchemy_MetaBox(array(
			'id'				=> '_homepage_slide',
			'title'				=> 'Homepage Slide',
			'types'             => array('homepage_slide'),
			'template'			=> APPLICATION_PATH . '/wpalchemy/metaboxes/homepage_slide.php'
		));


		$pod = new WPAlchemy_MetaBox(array(
			'id'				=> '_pod',
			'title'				=> 'Pod',
			'types'				=> array('pod'),
			'template'			=> APPLICATION_PATH .'/wpalchemy/metaboxes/pod.php'
		));

		$testimonial = new WPAlchemy_MetaBox(array(
			'id'				=> '_testimonial',
			'title'				=> 'Testimonial',
			'types'             => array('testimonial'),
			'template'			=> APPLICATION_PATH . '/wpalchemy/metaboxes/testimonial.php'
		));

		$team = new WPAlchemy_MetaBox(array(
			'id'				=> '_team',
			'title'				=> 'Team',
			'types'             => array('team'),
			'template'			=> APPLICATION_PATH . '/wpalchemy/metaboxes/team.php'
		));

		$service = new WPAlchemy_MetaBox(array(
			'id'				=> '_service',
			'title'				=> 'Service',
			'types'             => array('service'),
			'template'			=> APPLICATION_PATH . '/wpalchemy/metaboxes/service.php'
		));
	
	}

	protected function _init_sidebars()
	{

	}

	protected function _init_menus()
	{
		register_nav_menus(
			array(
				'primary-nav' 		=> __('Primary Navigation'),
			)
		);

		wp_create_nav_menu('Primary Navigation');
	}

	protected function _init_short_codes()
	{
		add_shortcode('auto-gallery', 'auto_gallery');
	}

	protected function _init_filters_and_actions()
	{
		add_filter('embed_oembed_html', 'prettify_oembed', 10, 3);

		add_filter('excerpt_length', 'custom_excerpt_length');
		add_filter('excerpt_more', 'custom_excerpt_more');

		add_action('template_redirect', array(&$this, 'form_handler'));
	}

	protected function _init_oembed_providers()
	{
		wp_oembed_add_provider('http://soundcloud.com/*', 'http://soundcloud.com/oembed');
		add_filter('oembed_dataparse', 'filter_soundcloud', 10, 3);
	}	

	protected function _init_admin_styles()
	{
		add_editor_style('editor-style.css');
	}

    protected function _init_frontend_scripts()
    {
        add_action('wp_enqueue_scripts', array(&$this, 'load_scripts'));
    }  	

	protected function _init_theme_options()
	{
		// Theme options are all the custom options like for example social profiles, could have URLs there and they are availible throughout the theme
		//require_once(LIBRARY_PATH . '/../includes/theme-options.php');
	}

    public function load_scripts()
    {
        wp_deregister_script('jquery');
        
        wp_enqueue_script('functions', get_bloginfo('template_directory') . '/assets/js/script.min.js', array(), false, true);
    }	

	public function form_handler()
	{
		require_once(LIBRARY_PATH . '/form/handler.php');

		return Form_Handler::get_instance()->run();
	}
}