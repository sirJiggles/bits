<?php

/**
 * Cuztom Field Class
 *
 * @author Gijs Jorissen
 * @since 0.3.3
 *
 */
class Cuztom_Post_Meta_Field
{
	
	/**
	 * Outputs a field based on its type
	 *
	 * @param string $field_id_name
	 * @param array $type
	 * @param array $meta
	 * @return mixed
	 *
	 * @author Gijs Jorissen
	 * @since 0.2
	 *
	 */
	static function output($field_id_name, $field, $value = '')
	{		
		switch($field['type']) :
			
			case 'text' :
				echo '<input type="text" name="cuztom[' . $field_id_name . ']" id="' . $field_id_name . '" value="' . $value . '" />';
			break;
			
			case 'textarea' :
				echo '<textarea name="cuztom[' . $field_id_name . ']" id="' . $field_id_name . '">' . $value . '</textarea>';
			break;
			
			case 'checkbox' :
				echo '<input type="checkbox" name="cuztom[' . $field_id_name . ']" id="' . $field_id_name . '" ' . checked($value, 'on', false) . ' />';
			break;
			
			case 'yesno' :
				echo '<input type="radio" name="cuztom[' . $field_id_name . ']" id="' . $field_id_name . '_yes" value="yes" ' . checked($value, 'yes', false) . ' />';
				echo '<label for="' . $field_id_name . '_yes">' . __('Yes') . '</label>';
				
				echo '<input type="radio" name="cuztom[' . $field_id_name . ']" id="' . $field_id_name . '_no" value="no" ' . checked($value, 'no', false) . ' />';
				echo '<label for="' . $field_id_name . '_no">' . __('No') . '</label>';
			break;
			
			case 'select' :
				echo '<select name="cuztom[' . $field_id_name . ']" id="' . $field_id_name . '">';
					foreach($field['options'] as $slug => $name)
					{
						echo '<option value="' . Inflector::uglify($slug) . '" ' . selected(Inflector::uglify($slug), $value, false) . '>' . Inflector::beautify($name) . '</option>';
					}
				echo '</select>';
			break;
			
			case 'checkboxes' :
				foreach($field['options'] as $slug => $name)
				{
					echo '<input type="checkbox" name="cuztom[' . $field_id_name . '][]" id="' . $field_id_name . '_' . Inflector::uglify($slug) . '" value="' . Inflector::uglify($slug) . '" ' . (in_array(Inflector::uglify($slug), maybe_unserialize($value)) ? 'checked="checked"' : '') . ' /><label for="' . $field_id_name . '_' . Inflector::uglify($slug) . '">' . Inflector::beautify($name) . '</label>';
				}
			break;
			
			case 'radio' :
				foreach($field['options'] as $slug => $name)
				{
					echo '<input type="radio" name="cuztom[' . $field_id_name . ']" id="' . $field_id_name . '_' . Inflector::uglify($slug) . '" value="' . Inflector::uglify($slug) . '" ' . checked(Inflector::uglify($slug), $value, false) . ' /><label for="' . $field_id_name . '_' . Inflector::uglify($slug) . '">' . Inflector::beautify($name) . '</label>';
				}
			break;
			
			case 'wysiwyg' :
				wp_editor($value, $field_id_name, array_merge(
					
					// Default
					array(
						'textarea_name' => 'cuztom[' . $field_id_name . ']',
						'media_buttons' => false
					),
					
					// Given
					isset($field['options']) ? $field['options'] : array()
				
				));
			break;
			
			case 'image' :
				echo '<input type="file" name="cuztom[' . $field_id_name . ']" id="' . $field_id_name . '"  />';
				
				if (!empty($value)) echo '<img src="' . $value . '" />';
			break;
			
			case 'date' :
				echo '<input type="text" name="cuztom[' . $field_id_name . ']" id="' . $field_id_name . '" class="cuztom_datepicker datepicker" value="' . $value . '" />';
			break;
			
			default:
				echo __('Input type not available');
			break;
			
		endswitch;
	}
}