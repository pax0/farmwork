<?php
return [
	//数据库相关配置
	'db_host'     =>    '127.0.0.1',
	'db_user'     =>    'root',
	'db_pwd'     =>    '',
	'db_name'     =>    'labframe',
	'db_table_prefix'     =>    'lab_',    //数据表前缀
	'db_charset'     =>    'utf8',

//	'default_module'    => 'home',    //默认模块
	'default_controller'     =>    'welcome',    //默认控制器
	'default_action'     =>    'index',    //默认操作方法
	'url_type'          =>      2,    // RUL模式：【1：普通模式，采用传统的 url 参数模式】【2：PATHINFO 模式，也是默认模式】

	'cache_path'     =>    APP_PATH . 'cache' .DS,    //缓存存放路径
	'cache_prefix'     =>    'cache_',    //缓存文件前缀
	'cache_type'     =>    'file',        //缓存类型（只实现 file 类型）

	'view_path'    => APP_PATH . 'views' . DS,    // 模板路径
	'view_suffix'  => '.php',    // 模板后缀
	'rewrite_short_tags' => true,

	'auto_cache'     => false,    //开启自动缓存
	'url_html_suffix'        => 'html',     // URL伪静态后缀

];