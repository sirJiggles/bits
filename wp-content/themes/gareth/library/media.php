<?php

class Media
{
	public static function get_video_data($video_id, $post)
	{
		$video_key = '_video_details_' . md5($video_id);
		$video_data = get_post_meta($post->ID, $video_key, true);

		if (empty($video_data)) {		
			if (is_numeric($video_id)) {
				$temp_data = unserialize(@file_get_contents("http://vimeo.com/api/v2/video/{$video_id}.php"));
				
				if (!empty($temp_data)) {
					$video_data = array(
						'id'			=> $video_id,
						'url'			=> $temp_data[0]['url'],
						'title'			=> $temp_data[0]['title'],
						'description'	=> $temp_data[0]['description'],
						'thumbnail'		=> $temp_data[0]['thumbnail_large'],
					);

					add_post_meta($post->ID, $video_key, $video_data, true);
				}
			} else {
				require_once(LIBRARY_PATH . '/Zend/Gdata/YouTube.php');

				$yt = new Zend_Gdata_YouTube();
				$video_entry = $yt->getVideoEntry($video_id);

				$video_data = array(
					'id'			=> $video_id,
					'url'			=> $video_entry->getVideoWatchPageUrl(),
					'title'			=> $video_entry->getVideoTitle(),
					'description'	=> $video_entry->getVideoDescription(),
					'thumbnail'		=> "http://img.youtube.com/vi/{$video_id}/hqdefault.jpg",
				);

				add_post_meta($post->ID, $video_key, $video_data, true);													
			}

			if (empty($video_data)) return false;
		}

		return $video_data;	
	}

	public static function get_audio_data($audio_id, $post)
	{
		$client_id = '390c73e67e587c29c1222bc1121c575c';

		$audio_key = '_audio_details_' . md5($audio_id);
		$audio_data = get_post_meta($post->ID, $audio_key, true);
		$has_data = false;

		if (empty($video_data)) {
			$temp_data = json_decode(@file_get_contents("http://api.soundcloud.com/tracks/{$audio_id}.json?client_id={$client_id}"));

			if (!empty($temp_data)) {
				$has_data = true;
				$audio_data = array(
					'id'			=> $audio_id,
					'url'			=> $temp_data->uri,
					'title'			=> $temp_data->title,
					'description'	=> $temp_data->description,
				);

				add_post_meta($post->ID, $audio_key, $audio_data, true);
			}

			if (empty($audio_data)) return false;
		}

		return $audio_data;
	}
}