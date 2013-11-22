<?php

require_once(LIBRARY_PATH . '/form/abstract.php');

class Form_Newsletter extends Form_Abstract
{
	private static $_instance;

	public static function get_instance()
	{
		if (!self::$_instance)
		{
			self::$_instance = new self;
		}

		return self::$_instance;
	}

	public function __construct()
	{
		$this->_fields = array(
			'fname' => array(
				'label' 		=> 'Name',
				'validation'	=> array(
					'required'	=> true,
					'minlength'	=> 3,
					'maxlength'	=> 255,
				),
			),
			'email'	=> array(
				'label'			=> 'Email',
				'validation'	=> array(
					'required'	=> true,
					'email'		=> true,
					'minlength'	=> 3,
					'maxlength'	=> 255,					
				),
			)
		);

		parent::__construct();
	}
	
	public function process()
	{
		global $wpdb;

		$post = get_page_by_title('Homepage');
		
		$fname = Uri::get_param('fname');
		$email = Uri::get_param('email');
	
		$to = 'gareth126@gmail.com';

		$subject = 'Website newsletter sign up';
		$body = "Name: {$fname} \n\n";
		$body .= "Email: {$email} \n\n";

		$headers = 'From:' . $email . "\r\n" . 'Reply-To:' . $email . "\r\n" . 'X-Mailer: PHP/' . phpversion();

		$sent = mail($to, $subject, $body, $headers);

		return parent::process();
		
	}
}