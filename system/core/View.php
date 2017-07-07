<?php
namespace core;

use core\Config;    //使用配置类
use core\Parser;    //使用模板解析类
use core\Output;
/**
 * 视图类
 */
class View
{
	//模板变量
	public $vars = [];
	protected $_view_path = '';

	function __construct($vars =[])
	{
		if (!is_dir(Config::get('cache_path')) || !is_dir(Config::get('view_path'))) {
			exit('The directory does not exist');
		}
		$this->_ci_ob_level = ob_get_level();
		$this->vars = $vars;
		$this->_view_path = Config::get('view_path');
	}

	public function view($view, $vars = array())
	{
		$ext = pathinfo($view, PATHINFO_EXTENSION);
		$file = $ext == '' ? $view . '.php' : $view;
		if(!file_exists($this->_view_path.$file))
		{
			exit('The view does not exist');
		}
		$view_path = $this->_view_path.$file;
		extract($vars);

		ob_start();

		if ((bool) @ini_get('short_open_tag') === FALSE AND Config::get('rewrite_short_tags') == TRUE)
		{
			echo @eval('?>'.preg_replace("/;*\s*\?>/", "; ?>", str_replace('<?=', '<?php echo ', file_get_contents($view_path))));
		}
		else
		{
			include($view_path);
			ob_clean();
		}
		if (ob_get_level() > $this->_ci_ob_level + 1)
		{
			ob_end_flush();
		}
		else
		{
			$out = Output::get_output();
			$out->append_output(ob_get_contents());
			@ob_end_clean();
		}
	}
}