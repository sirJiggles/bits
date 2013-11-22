<?php

class Site
{
	public static function get_option($option, $default = false)
	{
		$options = get_option('theme_options');

		if (!empty($options[$option])) {
			return $options[$option];
		} elseif ($default) {
			return $default;
		} else {
			return false;
		}
	}

	public static function get_page_description()
	{
		global $post;

		if (is_front_page()) {
			return get_bloginfo('description');
		} else {
			$length = 150;
			$text = $post->post_content;

			$text = str_replace(array("\r\n", "\r", "\n", "  "), " ", $text);
			$text = str_replace(array("\""), "", $text);
			$text = trim(strip_tags($text));
			
			$words = explode(' ', $text);

			if (count($words) > $length) {
				$words = array_slice($words, 0, $length);
			}

			return implode(' ', $words);
		}
	}
}