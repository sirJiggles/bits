<?php

class Walker_Primary extends Walker_Nav_Menu
{
	/**
	 * Start the element output.
	 *
	 * @param  string $output Passed by reference. Used to append additional content.
	 * @param  object $item   Menu item data object.
	 * @param  int $depth     Depth of menu item. May be used for padding.
	 * @param  array $args    Additional strings.
	 * @return void
	 */	
	public function walk($elements, $max_depth){

		$output = '';
		
		$output .= '<ul>';
		foreach($elements as $element){
			$output .= '<li><a href="'.$element->url.'" title="'.$element->attr_title.'">'.$element->title.'</a></li>';
		}
		$output .= '</ul>';

		echo $output;

	}
}