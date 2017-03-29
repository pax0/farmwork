<?php
namespace core;

/**
 * 路由类
 */
use core\Config;

class Router
{
	public $url_query;    //URL 串
	public $url_type;    //UTL 模式
	public $route_url = [];    //URL数组

	function __construct()
	{
		$this->url_query = parse_url($_SERVER['REQUEST_URI']);
	}

	//设置 URL 模式
	public function setUrlType($url_type = 2)
	{
		if ($url_type > 0 && $url_type < 3) {
			$this->url_type = $url_type;
		} else {
			exit('Specifies the URL does not exist!');
		}
	}

	//获取URL数组
	public function getUrlArray()
	{
		$this->makeUrl();
		return $this->route_url;
	}

	//处理 URL
	public function makeUrl()
	{
		switch ($this->url_type) {
			case 1:
				$this->queryToArray();
				break;

			case 2:
				$this->pathinfoToArray();
				break;
		}
	}

	//将参数形式转为数组
	public function queryToArray()
	{
		$arr = !empty($this->url_query['query']) ? explode('&', $this->url_query['query']) : [];
		$array = $tmp = [];
		if (count($arr) > 0) {
			foreach ($arr as $item) {
				$tmp = explode('=', $item);
				$array[$tmp[0]] = $tmp[1];
			}
			if (isset($array['controller'])) {
				$this->route_url['controller'] = $array['controller'];
				unset($array['controller']);
			}
			if (isset($array['action'])) {
				$this->route_url['action'] = $array['action'];
				unset($array['action']);
			}
			if (isset($this->route_url['action']) && strpos($this->route_url['action'], '.')) {
				//判断url方法名后缀 形如 'index.html',前提必须要在地址中以 localhost:8080/index.php 开始
				if (explode('.', $this->route_url['action'])[1] != Config::get('url_html_suffix')) {
					exit('suffix errror');
				} else {
					$this->route_url['action'] = explode('.', $this->route_url['action'])[0];
				}
			}
		} else {
			$this->route_url = [];
		}
	}

	//将 pathinfo 转为数组
	public function pathinfoToArray()
	{
		if ( ! isset($_SERVER['REQUEST_URI'], $_SERVER['SCRIPT_NAME']))
		{
			return '';
		}

		$uri = parse_url('http://vvke'.$_SERVER['REQUEST_URI']);
		$query = isset($uri['query']) ? $uri['query'] : '';
		$uri = isset($uri['path']) ? $uri['path'] : '';
		if (isset($_SERVER['SCRIPT_NAME'][0]))
		{
			if (strpos($uri, $_SERVER['SCRIPT_NAME']) === 0)
			{
				preg_match('/.*?\/index.php/', $uri, $test);
				$uri = (string) substr($uri, strlen($test[0]));
			}
			elseif (strpos($uri, dirname($_SERVER['SCRIPT_NAME'])) === 0)
			{
				$uri = (string) substr($uri, strlen(dirname($_SERVER['SCRIPT_NAME'])));
			}
		}

		if (trim($uri, '/') === '' && strncmp($query, '/', 1) === 0)
		{
			$query = explode('?', $query, 2);
			$uri = $query[0];
			$_SERVER['QUERY_STRING'] = isset($query[1]) ? $query[1] : '';
		}
		else
		{
			$_SERVER['QUERY_STRING'] = $query;
		}

		parse_str($_SERVER['QUERY_STRING'], $_GET);

		if ($uri === '/' OR $uri === '')
		{
			return;
		}

		$arr = explode('/', trim($uri, '/'));
		if (isset($arr[0]) && !empty($arr[0])) {
			$this->route_url['controller'] = $arr[0];
		}
		if (isset($arr[1]) && !empty($arr[1])) {
			$this->route_url['action'] = $arr[1];
		}
	}
}