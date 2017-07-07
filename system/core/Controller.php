<?php
namespace core;

use core\View;

class Controller
{
	private static $instance;

	public function __construct()
	{
		self::$instance =& $this;
		$this->view = new View();
	}

	public static function &get_instance()
	{
		return self::$instance;
	}
}