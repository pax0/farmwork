<?php
define('DS', DIRECTORY_SEPARATOR);
define('ROOT_PATH', __DIR__ . DS);
define('APP_PATH', ROOT_PATH . 'app' . DS);    //定义应用程序目录路径
define('CORE_PATH', ROOT_PATH . 'system' . DS . 'core' . DS);    //定义框架核心目录路径


require CORE_PATH . 'Tk.php';
core\App::run();