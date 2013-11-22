<?php

class Form_Handler
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

	public function get_form_class($form)
	{
		try {
			require_once(APPLICATION_PATH . '/form/' . $form . '.php');
		} catch (Exception $e) {
			die('Form file not found');
		}		

		$form_class_name = 'Form_' . ucfirst($form);

		return call_user_func($form_class_name . '::get_instance');
	}

	public function run()
	{
		if (isset($_POST['form']) && $form_id = Uri::get_param('form')) {
			$form = $this->get_form_class($form_id);

			if ($form->validate()) {
				$form->process();
			}
		}
	}	
}