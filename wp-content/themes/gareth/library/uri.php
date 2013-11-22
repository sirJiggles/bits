<?php

class Uri
{
	public static function create(array $params = array(), array $not = array())
	{
		// Get HTTPS
		$s = empty($_SERVER['HTTPS']) ? '' : ($_SERVER['HTTPS'] == 'on') ? 's' : '';

		// Get current protocol
		$protocol = substr(strtolower($_SERVER['SERVER_PROTOCOL']), 0, strpos(strtolower($_SERVER['SERVER_PROTOCOL']), '/')) . $s;
		
		// Get current URL
		$base_url = $protocol . "://" . $_SERVER['SERVER_NAME'];
		
		// Get pretty Wordpress params
		$query = $_SERVER['REQUEST_URI'];
		$pretty_query = (strpos($query, '?') !== false) ? substr($query, 0, strpos($query, '?')) : $query;

		// Merge current and new params
		$query_vars = array_merge($_GET, $params);

		// Allows removal of params from array
		if (!empty($not)) {
			foreach ($not as $to_remove) {
				if (array_key_exists($to_remove, $query_vars)) unset($query_vars[$to_remove]);
			}
		}

		// Build query string
		$query_string = (count($query_vars) > 0) ? '?' . http_build_query($query_vars) : '';

		return $base_url . $pretty_query . $query_string;
	}

	public static function get_param($key, $default = false)
	{
		if (isset($_POST[$key]) || isset($_GET[$key]) || strlen(get_query_var($key))) {
			if (isset($_POST[$key])) return $_POST[$key];
			if (isset($_GET[$key])) return $_GET[$key];
			if (strlen(get_query_var($key)) > 0) return get_query_var($key);
		} elseif ($default) {
			return $default;
		} else {
			return false;
		}
	}	
}