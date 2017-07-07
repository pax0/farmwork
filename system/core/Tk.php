<?php
//框架启动文件
//define('RUNTIME_PATH', ROOT_PATH . 'runtime' . DS);    //定义框架运行时目录路径
define('CONF_PATH', APP_PATH . 'config' . DS);        //定义全局配置目录路径

//引入自动加载文件
require CORE_PATH . 'Loader.php';

//实例化自动加载类
$loader = new core\Loader();
$loader->addNamespace('core',ROOT_PATH . 'system' .DS . 'core');        //添加命名空间对应base目录
$loader->addNamespace('controllers',APP_PATH);
$loader->register();    //注册命名空间

//加载全局配置
\core\Config::set(include CONF_PATH . 'config.php');

$RTR = new core\Router();
$RTR->pathinfoToArray();

$OUT = new core\Output();

$class = $RTR->route_url['controller'];
$method = $RTR->route_url['action'];

include_once APP_PATH . 'controllers' . DS . $class . '.php';

$TK = new $class;
$TK->$method();
$OUT->_display();

