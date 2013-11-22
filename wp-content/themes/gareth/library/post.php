<?php

class Post
{
	public static function has_children($post)
	{
		$children = get_children(array(
			'post_parent' 	=> $post->ID,
			'post_type'		=> $post->post_type,
		));

		return !empty($children);
	}

	public static function get_page_children($post)
	{
		return get_children(array(
			'post_parent'	=> $post->ID,
			'post_type'		=> $post->post_type,
			'orderby'		=> 'menu_order',
			'order'			=> 'ASC',
		));
	}

	public static function get_siblings($post)
	{	
		return get_children(array(
			'post_parent' 	=> (self::get_parent_post($post)->ID == $post->ID) ? 0 : self::get_parent_post($post)->ID,
			'post_type'		=> $post->post_type,
			'orderby'		=> 'menu_order',
			'order'			=> 'ASC',		
		));
	}

	public static function get_parent_post($post)
	{
		return get_post($post->post_parent);
	}

	public static function get_root_post($post)
	{
		$postID = (empty($post->ancestors)) ? $post->ID : end($post->ancestors);

		return get_post($postID);
	}

	public static function get_first_post($post)
	{
		global $wpdb;

		return $wpdb->get_row("
			SELECT * FROM $wpdb->posts 
			WHERE post_parent = $post->ID 
			AND post_status = 'publish' 
			ORDER BY menu_order ASC, post_date ASC 
			LIMIT 1"
		);		
	}

	public static function get_last_post($post)
	{
		global $wpdb;

		return $wpdb->get_row("
			SELECT * FROM $wpdb->posts 
			WHERE post_parent = $post->ID 
			AND post_status = 'publish' 
			ORDER BY menu_order DESC, post_date DESC 
			LIMIT 1"
		);		
	}

	public static function get_next_post($post, $loop = true)
	{
		global $wpdb;

		$result = $wpdb->get_row("
			SELECT * FROM $wpdb->posts 
			WHERE post_parent = $post->post_parent 
			AND ID <> $post->ID 
			AND post_status = 'publish' 
			AND post_type = '$post->post_type' 
			AND menu_order >= $post->menu_order 
			ORDER BY menu_order ASC, post_date ASC 
			LIMIT 1"
		);

		if (is_null($result) || ($result->menu_order == $post->menu_order && strtotime($result->post_date) < strtotime($post->post_date))) {
			if ($loop) {
				$result = $wpdb->get_row("
					SELECT * FROM $wpdb->posts 
					WHERE post_parent = $post->post_parent 
					AND post_status = 'publish' 
					AND post_type = '$post->post_type' 
					ORDER BY menu_order ASC, post_date ASC 
					LIMIT 1"
				);
			} else {
				return false;
			}
		}

		return $result;
	}

	public static function get_previous_post($post, $loop = true)
	{
		global $wpdb;

		$result = $wpdb->get_row("
			SELECT * FROM $wpdb->posts 
			WHERE post_parent = $post->post_parent 
			AND ID <> $post->ID 
			AND post_status = 'publish' 
			AND post_type = '$post->post_type' 
			AND menu_order <= $post->menu_order 
			ORDER BY menu_order DESC, post_date DESC 
			LIMIT 1"
		);


		if (is_null($result) || ($result->menu_order == $post->menu_order && strtotime($result->post_date) > strtotime($post->post_date))) {
			if ($loop) {
				$result = $wpdb->get_row("
					SELECT * FROM $wpdb->posts 
					WHERE post_parent = $post->post_parent 
					AND post_status = 'publish' 
					AND post_type = '$post->post_type' 
					ORDER BY menu_order DESC, post_date DESC 
					LIMIT 1"
				);
			} else {
				return false;
			}
		}

		return $result;
	}	

	public static function get_page_level($post)
	{
		$parent_id  = $post->post_parent;
		$depth = 0;

		while ($parent_id > 0) {
			$page = get_page($parent_id);
			$parent_id = $page->post_parent;
			$depth++;
		}

		return $depth;
	}

	public static function get_youtube_ids($post)
	{
		$matches = array();

		if (preg_match_all('~https?://(?:[0-9A-Z-]+\.)?(?:youtu\.be/|youtube\.com\S*[^\w\-\s])([\w\-]{11})(?=[^\w\-]|$)(?![?=&+%\w]*(?:[\'"][^<>]*>| </a>))[?=&+%\w-]*~ix', $post->post_content, $matches)) {
			$matches = $matches[1];
		}

		return array_reverse($matches);
	}

	public static function get_vimeo_ids($post)
	{
		$matches = array();

		if (preg_match_all('~https?://(?:www\.)?vimeo\.com/(?:clip:)?(\d+)~', $post->post_content, $matches)) {
			$matches = $matches[1];
		}

		return $matches;
	}

	public static function get_soundcloud_ids($post)
	{
		$matches = array();
		$embed_matches = array();
		$ids = array();

		if (preg_match_all('~https?://(?:www\.)?soundcloud\.com/.*/.*~', $post->post_content, $matches)) {
			$matches = $matches[0];
		}

		if (count(array_filter($matches)) > 0) {
			foreach ($matches as $match) {
				if (preg_match('~http://api.soundcloud.com/tracks/(\d+)~', wp_oembed_get($match), $embed_matches))
				{
					$ids[] = $embed_matches[1];
				}
			}
		}

		return $ids;		
	}

	public static function get_content_images($post)
	{
		$images = array();
		
		if (!empty($post->post_content)) {
			$doc = new DOMDocument();
			$doc->loadHTML($post->post_content);

			foreach ($doc->getElementsByTagName('img') as $img) {
				foreach (explode(' ', $img->getAttribute('class')) as $class) {
					if (stripos($class, 'wp-image') !== false) {
						$img_id = substr($class, 9);
					}
				}

				$images[] = array(
					'id'		=> $img_id,				
					'src'		=> $img->getAttribute('src'),
					'title'		=> $img->getAttribute('title'),
					'alt'		=> $img->getAttribute('alt'),
					'caption'	=> $img->getAttribute('caption'),
				);			
			}
		}

		return $images;
	}

	public static function get_header_images($post)
	{
		global $header_images;
		
		$ret = array();
		$post = self::get_root_post($post);
		$header_images->the_meta($post->ID);

		while ($header_images->have_fields('images')) {
			$ret[] = $header_images->get_the_value('imgurl');
		}

		if (empty($ret) && $post->post_title != 'The College') {
			$ret = self::get_header_images(get_page_by_title('The College'));
		}

		return $ret;
	}

	public static function get_feature_boxes($post, $limit = 999)
	{
		global $feature_boxes;
		
		$ret = array();
		$feature_boxes->the_meta($post->ID);

		while ($feature_boxes->have_fields('features', $limit)) {
			$ret[] = array(
				'image' 	=> $feature_boxes->get_the_value('imgurl'),
				'title' 	=> $feature_boxes->get_the_value('title'),
				'snippet' 	=> $feature_boxes->get_the_value('snippet'),
				'post_id' 	=> $feature_boxes->get_the_value('post'),
				'link_text' => $feature_boxes->get_the_value('link_text'),
			);
		}

		return $ret;		
	}

	public static function get_testimonials($post)
	{
		global $testimonials;
		
		$ret = array();
		$post = self::get_root_post($post);
		$testimonials->the_meta($post->ID);

		while ($testimonials->have_fields('testimonials')) {
			$ret[] = array(
				'image'	 	=> $testimonials->get_the_value('imgurl'),
				'author' 	=> $testimonials->get_the_value('author'),
				'title' 	=> $testimonials->get_the_value('title'),
				'quote' 	=> $testimonials->get_the_value('quote'),
			);
		}

		return $ret;
	}

	public static function get_author_link($post)
	{
		$options = get_option('theme_options');

		switch ($post->post_type) {
			case 'post' :
				$page = (isset($options['posts_page']) && $options['posts_page'] > 0) ? $options['posts_page'] : get_page_by_title('News')->ID;
				break;
			case 'event' :
				$page = (isset($options['events_page']) && $options['events_page'] > 0) ? $options['events_page'] : get_page_by_title('what\s On')->ID;
				break;
		}

		return get_permalink($page) . '?' . http_build_query(array('author' => $post->post_author));
	}
}