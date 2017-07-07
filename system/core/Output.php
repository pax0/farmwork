<?php
namespace core;

class Output
{
	private static $OUT;
	private $final_output;

	public function __construct()
	{
		self::$OUT =& $this;
	}

	public function append_output($output)
	{
		self::$OUT->final_output .= $output;
		return $this;
	}
	public function _display()
	{
		$output =self::$OUT->final_output;
		echo $output;
	}

	public static function &get_output()
	{
		return self::$OUT;
	}
}