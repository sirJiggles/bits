<?php

require_once(LIBRARY_PATH . '/form/abstract.php');

class Form_Contact extends Form_Abstract
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
			),
			'telephone' => array(
				'label'			=> 'Telephone',
				'validation'	=> array(
					'required'	=> false,
				)
			),
			'message'	=> array(
				'label'			=> 'Your message',
				'validation'	=> array(
					'required'	=> true,
					'antispam'	=> array(
						'name_field'	=> 'fname',
						'email_field'	=> 'email',
					),				
				),
			)
		);

		parent::__construct();
	}
	
	public function process()
	{
		global $wpdb;

		$post = get_page_by_title('Contact');
		
		$fname = Uri::get_param('fname');
		$email = Uri::get_param('email');
		$phone = Uri::get_param('telephone');
		$message = Uri::get_param('message');
		$specialist = Uri::get_param('specialist');

		$to = 'gareth126@gmail.com';

		$subject = 'Website contact us enquiry';
		$body = "Name: {$fname} \n\n";
		$body .= "Email: {$email} \n\n";
		$body .= "Telephone Number: {$phone} \n\n";
		if($specialist != 'none'){
			$body .= "Specialist area: {$specialist} \n\n";
		}
		$body .= "Message: {$message} \n\n";

		$headers = 'From:' . $email . "\r\n" . 'Reply-To:' . $email . "\r\n" . 'X-Mailer: PHP/' . phpversion();

		$sent = mail($to, $subject, $body, $headers);

		return parent::process();
		
	}
}