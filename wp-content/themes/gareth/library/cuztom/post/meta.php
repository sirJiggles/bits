<?php

/**
 * Registers the meta boxes
 *
 * @author Gijs Jorissen
 * @since 0.2
 *
 */
class Cuztom_Post_Meta
{
	var $box_id;
	var $box_title;
	var $box_context;
	var $box_priority;
	var $post_type_name;
	var $meta_fields;
	
	
	/**
	 * Constructs the meta box
	 *
	 * @param string $title
	 * @param array $fields
	 * @param string $post_type_name
	 * @param string $context
	 * @param string $priority
	 *
	 * @author Gijs Jorissen
	 * @since 0.2
	 *
	 */
	function __construct($title, $fields = array(), $post_type_name = null, $context = 'normal', $priority = 'default')
	{
		if (!empty($title))
		{
			$this->post_type_name 	= $post_type_name;
			
			// Meta variables	
			$this->box_id 			= Inflector::uglify($title);
			$this->box_title 		= Inflector::beautify($title);
			$this->box_context		= $context;
			$this->box_priority		= $priority;

			$this->meta_fields 	= $fields;

			add_action('admin_init', array($this, 'add_meta_box'));
		}
		
		// Add multipart for files
		add_action('post_edit_form_tag', array($this, 'post_edit_form_tag'));
		
		// Listen for the save post hook
		add_action('save_post', array($this, 'save_post'));		
	}
	
	
	/**
	 * Method that calls the add_meta_box function
	 *
	 * @author Gijs Jorissen
	 * @since 0.2
	 *
	 */
	public function add_meta_box()
	{			
		add_meta_box(
			$this->box_id,
			$this->box_title,
			array($this, 'callback'),
			$this->post_type_name,
			$this->box_context,
			$this->box_priority
		);
	}
	
	
	/**
	 * Main callback function of add_meta_box
	 *
	 * @param object $post
	 * @param object $data
	 * @return mixed
	 *
	 * @author Gijs Jorissen
	 * @since 0.2
	 *
	 */
	public function callback($post, $data)
	{
		// Nonce field for validation
		wp_nonce_field(plugin_basename(__FILE__), 'cuztom_nonce');

		// Get all inputs from $data
		$meta_fields = $this->meta_fields;
		
		// Check the array and loop through it
		if (!empty($meta_fields))
		{
			echo '<div class="cuztom_helper">';
				echo '<table border="0" cellading="0" cellspacing="0" class="cuztom_table cuztom_helper_table">';
						
					/* Loop through $meta_fields */
					foreach($meta_fields as $field)
					{
						$field_id_name = '_' . Inflector::uglify($this->box_title) . "_" . Inflector::uglify($field['name']);
						$meta = get_post_meta($post->ID, $field_id_name);
					
						echo '<tr>';
							echo '<th class="cuztom_th th">';
								echo '<label for="' . $field_id_name . '" class="cuztom_label">' . $field['label'] . '</label>';
								echo '<div class="cuztom_description description">' . $field['description'] . '</div>';
							echo '</th>';
							echo '<td class="cuztom_td td">';
						
								Cuztom_Post_Meta_Field::output($field_id_name, $field, isset($meta[0]) ? $meta[0] : '');
							
							echo '</td>';
						echo '</tr>';
					}
				
				echo '</table>';
			echo '</div>';
		}
	}
	
	
	/**
	 * Hooks into the save hook for the newly registered Post Type
	 *
	 * @author Gijs Jorissen
	 * @since 0.1
	 *
	 */
	public function save_post()
	{		
		// Deny the wordpress autosave function
		if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
		if (!isset($_POST['cuztom_nonce'])) return;

		if ($_POST && !wp_verify_nonce($_POST['cuztom_nonce'], plugin_basename(__FILE__))) return;
		if (!isset($_POST)) return;
		
		global $post;
		if (!isset($post->ID) && get_post_type($post->ID) !== $this->post_type_name) return;
		
		// Loop through each meta box
		if (!empty($this->meta_fields))
		{
			foreach($this->meta_fields as $field)
			{
				$field_id_name = '_' . Inflector::uglify($this->box_title) . "_" . Inflector::uglify($field['name']);
							
				if ($field['type'] == 'image')
				{					
					if (isset($_FILES) && !empty($_FILES['cuztom']['tmp_name'][$field_id_name]))
					{
						$upload = wp_upload_bits(
							$_FILES['cuztom']['name'][$field_id_name], 
							null, 
							file_get_contents($_FILES['cuztom']['tmp_name'][$field_id_name]) 
						);
						
						if (isset($upload['error']) && $upload['error'] != 0) 
						{  
			                wp_die('There was an error uploading your file: ' . $upload['error']);  
			            } else {  
			                update_post_meta($post->ID, $field_id_name, $upload['url']);
			            }
					}
				}
				else
				{
					$field_id_name = '_' . Inflector::uglify($this->box_title) . "_" . Inflector::uglify($field['name']);				
					update_post_meta($post->ID, $field_id_name, $_POST['cuztom'][$field_id_name]);
				}
			}			
		}		
	}
	
	
	/**
	 * Adds multipart support to the post form
	 *
	 * @return mixed
	 *
	 * @author Gijs Jorissen
	 * @since 0.2
	 *
	 */
	function post_edit_form_tag()
	{
		echo ' enctype="multipart/form-data"';
	}
}