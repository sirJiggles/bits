<?php

class Form_Abstract
{
	protected $_fields;
	protected $_errors;
	protected $_submitted;

	public function __construct()
	{
		$this->_submitted = false;
	}

	public function validate()
	{
		foreach ($this->_fields as $field => $properties) {

			$input = trim(Uri::get_param($field));

			if (isset($properties['validation'])) {
				foreach ($properties['validation'] as $rule => $value) {
					switch ($rule) {
						case 'required' :
							if (($value == true && strlen($input) == 0) || ($value == 'select' && $input == '-1')) {
								$this->_errors[$field] = "{$properties['label']} is required";
								break 2;
							}

							break;

						case 'minlength' :
							if (strlen($input) < $value) {
								$this->_errors[$field] = "{$properties['label']} must be more than {$value} characters";
								break 2;
							}

							break;

						case 'maxlength' :
							if (strlen($input) > $value) {
								$this->_errors[$field] = "{$properties['label']} must be fewer than {$value} characters";
								break 2;
							}						

							break;

						case 'minvalue' :
							if ($input < $value) {
								$this->_errors[$field] = "{$properties['label']} must be greater than {$value}";
								break 2;
							}

							break;

						case 'maxvalue' :
							if ($input > $value) {
								$this->_errors[$field] = "{$properties['label']} must be less than {$value}";
								break 2;
							}						

							break;

						case 'numeric' :
							if ($value == true && !is_numeric($input)) {
								$this->_errors[$field] = "{$properties['label']} must be numeric";
								break 2;
							}						

							break;

						case 'email' :
							if ($value == true && !filter_var($input, FILTER_VALIDATE_EMAIL)) {
								$this->_errors[$field] = "{$properties['label']} must be a valid email address";
								break 2;
							}

							break;

						case 'url' :
							if ($value == true && !filter_var($input, FILTER_VALIDATE_URL)) {
								$this->_errors[$field] = "{$properties['label']} must be a valid URL";
								break 2;
							}

							break;							

						case 'antispam' :
							$api_key = get_option('wordpress_api_key');

							if (!empty($api_key)) {
								include(LIBRARY_PATH . '/akismet.php');

								$akismet = new Akismet(get_bloginfo('url'), $api_key);
								$akismet->setCommentAuthor(Uri::get_param($value['name_field']));
								$akismet->setCommentAuthorEmail(Uri::get_param($value['name_field']));
								$akismet->setCommentContent($input);

								if ($akismet->isCommentSpam()) {
									$this->_errors[$field] = "{$properties['label']} appears to be spam";
									break 2;
								}
							}						

							break;

						default :
					}
				}
			}
		}

		return (count($this->_errors) == 0) ? true : false;
	}

	public function process()
	{
		$this->_submitted = true;
	}

	public function submitted()
	{
		return $this->_submitted;
	}

	public function errors()
	{
		$c = '';

		if (count($this->_errors) > 0) {
			$c .= '<div class="errors"><p>There are ' . count($this->_errors) . ' errors with your form:</p>';
				$c .= '<ol>';
					foreach ($this->_errors as $field => $message)
					{
						$c .= '<li>' . $message . '</li>';
					}
				$c .= '</ol>';
			$c .= '</div>';
		}

		return $c;
	}

	public function row_class($row)
	{
		return $this->_errors[$row] ? 'form-error-row' : '';
	}

	public function error_for($field)
	{
		if ($this->_errors[$field]) return $this->_errors[$field];
	}	
}