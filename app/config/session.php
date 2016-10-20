<?php

/**
 * @author: ryan<zer0131@vip.qq.com>
 * @desc: session设置文件
 */

$common = array(
    'auto_start' => true,
    'save_path' => APP_PATH . DS . 'session',
);

$online = array();

$dev = array();

return DEBUG ? array_merge($common, $dev) : array_merge($common, $online);