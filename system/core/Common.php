<?php
namespace core;

use core\Config;
use core\Controller;

function &load_class($class, $dir, $param){
	static $_classes = array();

	//如果类已存在（实例化）
	if (isset($_classes[$class]))
	{
		return $_classes[$class];
	}

}

function &get_config()
{

}