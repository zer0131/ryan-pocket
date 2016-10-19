<?php

/**
 * @author: ryan<zer0131@vip.qq.com>
 * @desc: session设置文件
 */

$common = array(
    'auto_start' => true,
    //'name' => '',
    'path' => APP_PATH . DS . 'session',
    //'gc_maxlifetime' => 1800,
    //'cookie_lifetime' => 1800,
    'cookie_httponly' => 1,
);

$online = array();

$dev = array();

return DEBUG ? array_merge($common, $dev) : array_merge($common, $online);