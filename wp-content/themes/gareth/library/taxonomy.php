<?php

class Taxonomy
{
	public static function get_terms($name, array $options = array())
	{
		if (!taxonomy_exists($name)) return false;

		global $wpdb;

		$query = "
			SELECT * FROM $wpdb->terms 
			LEFT JOIN $wpdb->term_taxonomy ON $wpdb->terms.term_id = $wpdb->term_taxonomy.term_id 
			WHERE $wpdb->term_taxonomy.taxonomy = '{$name}'
		";

		if (!empty($options)) {
			if (isset($options['orderby']) && isset($options['order'])) $query .= " ORDER BY {$options['orderby']} {$options['order']}";
			if (isset($options['limit'])) $query .= " LIMIT {$options['limit']}";
		}	

		return $wpdb->get_results($query);
	}
}