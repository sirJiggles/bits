<?php

require_once 'wp-blog-header.php';

global $wpdb;
global $find;
global $replace;

$find = 'http://tyrella.dev/';
$replace = 'http://tyrrell.uat.honestideas.co.uk/';


$tables = array(
	'posts',
	'postmeta',
	'comments',
	'commentmeta',
	'options',
);

echo "Beginning find and replace<br />\n";

foreach ($tables as $table) {
	$query = "SELECT * FROM {$wpdb->$table}";
	$rows = $wpdb->get_results($query, ARRAY_A);

	$pk = $wpdb->get_col_info('name', 0);

	foreach ($rows as $row) {
		foreach ($row as $column => $value) {
			if (stripos($value, $find) !== false) {

				// Match test site URL
				if (stripos($value, $find) !== false) {
					// Get multidimensional values array
					$value_arr = @unserialize($value);

					// Is value unserializable?
					if ($value_arr !== false) {
						// Replace all instances of old URL with new URL
						if (is_array($value_arr)) array_walk_recursive($value_arr, 'replace_url');

						// Serialise new values array
						$value_string = serialize($value_arr);
					} else {
						$value_string = str_replace($find, $replace, $value);
					}

					// Update database
					$wpdb->update($wpdb->$table, array($column => $value_string), array($pk => $row[$pk]));

					// Debug?
					echo "Replaced URL in column {$column} of {$table} where {$pk} = {$row[$pk]}<br />\n";
				}
			}
		}
	}
}

echo "All done!<br />\n";

function replace_url(&$item, $key)
{
	global $find;
	global $replace;
	
	$item = str_replace($find, $replace, $item);
}

?>