<?php

/**
 * @author ryan<zer0131@vip.qq.com>
 * @desc 统一入口
 */

if (version_compare(PHP_VERSION, '5.3.0', '<')) {
    die('require PHP > 5.3.0 !');
}

//--------定义目录分隔符--------//
define('DS', DIRECTORY_SEPARATOR);

//--------定义应用目录(必须)--------//
define('APP_PATH', dirname(dirname(__FILE__)));

//--------定义框架目录(必须)--------//
define('ONEFOX_PATH', dirname(APP_PATH) . DS . 'onefox');

//--------开启模块模式(Controller目录下含有子目录, 默认开启)--------//
define('MODULE_MODE', false);

//--------是否开启调试模式(默认关闭)--------//
define('DEBUG', true);

//--------日志目录(默认在app/logs目录下)--------//
//define('LOG_PATH', APP_PATH . DS . 'logs');

//--------配置目录(默认在app/config目录下)--------//
//define('CONF_PATH', APP_PATH . DS . 'config');

//--------模板目录(默认在app/tpl目录下)--------//
//define('TPL_PATH', APP_PATH . DS . 'tpl');

//--------扩展库目录(默认在app/lib目录下)--------//
//define('LIB_PATH', dirname(APP_PATH) . DS . 'class');

require ONEFOX_PATH . DS . 'Onefox.php';
