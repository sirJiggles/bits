<?php

class Inflector
{
	protected static $uncountable_words = array(
		'equipment', 'information', 'rice', 'money',
		'species', 'series', 'fish', 'meta'
	);

	protected static $plural_rules = array(
		'/^(ox)$/i'                 => '\1\2en',     // ox
		'/([m|l])ouse$/i'           => '\1ice',      // mouse, louse
		'/(matr|vert|ind)ix|ex$/i'  => '\1ices',     // matrix, vertex, index
		'/(x|ch|ss|sh)$/i'          => '\1es',       // search, switch, fix, box, process, address
		'/([^aeiouy]|qu)y$/i'       => '\1ies',      // query, ability, agency
		'/(hive)$/i'                => '\1s',        // archive, hive
		'/(?:([^f])fe|([lr])f)$/i'  => '\1\2ves',    // half, safe, wife
		'/sis$/i'                   => 'ses',        // basis, diagnosis
		'/([ti])um$/i'              => '\1a',        // datum, medium
		'/(p)erson$/i'              => '\1eople',    // person, salesperson
		'/(m)an$/i'                 => '\1en',       // man, woman, spokesman
		'/(c)hild$/i'               => '\1hildren',  // child
		'/(buffal|tomat)o$/i'       => '\1\2oes',    // buffalo, tomato
		'/(bu|campu)s$/i'           => '\1\2ses',    // bus, campus
		'/(alias|status|virus)$/i'  => '\1es',       // alias
		'/(octop)us$/i'             => '\1i',        // octopus
		'/(ax|cris|test)is$/i'      => '\1es',       // axis, crisis
		'/s$/i'                     => 's',          // no change (compatibility)
		'/$/i'                      => 's',
	);

	protected static $singular_rules = array(
		'/(matr)ices$/i'         => '\1ix',
		'/(vert|ind)ices$/i'     => '\1ex',
		'/^(ox)en/i'             => '\1',
		'/(alias)es$/i'          => '\1',
		'/([octop|vir])i$/i'     => '\1us',
		'/(cris|ax|test)es$/i'   => '\1is',
		'/(shoe)s$/i'            => '\1',
		'/(o)es$/i'              => '\1',
		'/(bus|campus)es$/i'     => '\1',
		'/([m|l])ice$/i'         => '\1ouse',
		'/(x|ch|ss|sh)es$/i'     => '\1',
		'/(m)ovies$/i'           => '\1\2ovie',
		'/(s)eries$/i'           => '\1\2eries',
		'/([^aeiouy]|qu)ies$/i'  => '\1y',
		'/([lr])ves$/i'          => '\1f',
		'/(tive)s$/i'            => '\1',
		'/(hive)s$/i'            => '\1',
		'/([^f])ves$/i'          => '\1fe',
		'/(^analy)ses$/i'        => '\1sis',
		'/((a)naly|(b)a|(d)iagno|(p)arenthe|(p)rogno|(s)ynop|(t)he)ses$/i' => '\1\2sis',
		'/([ti])a$/i'            => '\1um',
		'/(p)eople$/i'           => '\1\2erson',
		'/(m)en$/i'              => '\1an',
		'/(s)tatuses$/i'         => '\1\2tatus',
		'/(c)hildren$/i'         => '\1\2hild',
		'/(n)ews$/i'             => '\1\2ews',
		'/([^us])s$/i'           => '\1',
	);

	/**
	 * Checks if the given word has a plural version.
	 *
	 * @param   string  the word to check
	 * @return  bool    if the word is countable
	 */
	public static function is_countable($word)
	{
		return !(in_array(strtolower(strval($word)), self::$uncountable_words));
	}

	/**
	 * Add order suffix to numbers ex. 1st 2nd 3rd 4th 5th
	 *
	 * @param   int     the number to ordinalize
	 * @return  string  the ordinalized version of $number
	 * @link    http://snipplr.com/view/4627/a-function-to-add-a-prefix-to-numbers-ex-1st-2nd-3rd-4th-5th/
	 */
	public static function ordinalize($number)
	{
		if (!is_numeric($number))
		{
			return $number;
		}

		if (in_array(($number % 100), range(11, 13)))
		{
			return $number . 'th';
		}
		else
		{
			switch ($number % 10)
			{
				case 1:
					return $number . 'st';
					break;
				case 2:
					return $number . 'nd';
					break;
				case 3:
					return $number . 'rd';
					break;
				default:
					return $number . 'th';
					break;
			}
		}
	}

	/**
	 * Gets the plural version of the last word of the given string
	 *
	 * @param   string  the string to pluralize
	 * @return  string  the plural version of $word
	 */
	public static function pluralize($string)
	{
		$words = explode(' ', $string);
		$word = array_pop($words);
		$result = strval($word);

		if (!self::is_countable($result))
		{
			return $result;
		}

		foreach (self::$plural_rules as $rule => $replacement)
		{
			if (preg_match($rule, $result))
			{
				$result = preg_replace($rule, $replacement, $result);
				break;
			}
		}

		return implode(' ', array_merge($words, array($result)));
	}

	/**
	 * Gets the singular version of the last word of the given string
	 *
	 * @param   string  the string to singularize
	 * @return  string  the singular version of $word
	 */
	public static function singularize($string)
	{
		$words = explode(' ', $string);
		$word = array_pop($words);
		$result = strval($word);

		if (!self::is_countable($result))
		{
			return $result;
		}

		foreach (self::$singular_rules as $rule => $replacement)
		{
			if (preg_match($rule, $result))
			{
				$result = preg_replace($rule, $replacement, $result);
				break;
			}
		}

		return implode(' ', array_merge($words, array($result)));
	}

	/**
	 * Returns a human readable version of an uglified string
	 * 
	 * @param	string	the string to beautify
	 * @return	string	the beautified string
	 */
	public function beautify($string)
	{
		return ucwords(str_replace('_', ' ', $string));
	}

	/**
	 * Returns a lowercase, underscored version of a string
	 * 
	 * @param	string	the string to uglify
	 * @return	string	the uglified string
	 */
	public function uglify($string)
	{
		return strtolower(preg_replace('/[^A-z0-9]/', '_', $string));
	}

	public static function linkify($string)
	{
		return ereg_replace("[[:alpha:]]+://[^<>[:space:]]+[[:alnum:]/]","<a href=\"\\0\">\\0</a>", $string);
	}

	public static function twitterify($string, $username = false) {
		if ($username && stripos($string, $username) == 0) {
			$string = substr($string, strlen($username) + 2);
		}

		$string = preg_replace("#(^|[\n ])([\w]+?://[\w]+[^ \"\n\r\t< ]*)#", "\\1<a href=\"\\2\" target=\"_blank\">\\2</a>", $string);
		$string = preg_replace("#(^|[\n ])((www|ftp)\.[^ \"\t\n\r< ]*)#", "\\1<a href=\"http://\\2\" target=\"_blank\">\\2</a>", $string);
		$string = preg_replace("/@(\w+)/", "<a href=\"http://www.twitter.com/\\1\" target=\"_blank\">@\\1</a>", $string);
		$string = preg_replace("/#(\w+)/", "<a href=\"http://search.twitter.com/search?q=\\1\" target=\"_blank\">#\\1</a>", $string);
		
		return $string;
	}	

	public static function timesince($date) {
		$diff = time() - $date;

		if ($diff < 60)
			return $diff . " second" . self::plural_num($diff) . " ago";
		$diff = round($diff / 60);
		if ($diff < 60)
			return $diff . " minute" . self::plural_num($diff) . " ago";
		$diff = round($diff / 60);
		if ($diff < 24)
			return $diff . " hour" . self::plural_num($diff) . " ago";
		$diff = round($diff / 24);
		if ($diff < 7)
			return $diff . " day" . self::plural_num($diff) . " ago";
		$diff = round($diff / 7);
		if ($diff < 4)
			return $diff . " week" . self::plural_num($diff) . " ago";
		return date("F j, Y", $date);
	}

	public static function plural_num($num) {
		if ($num != 1) return 's';
	}	
}

