<?php

/**
 * @author: ryan<zer0131@vip.qq.com>
 * @desc: 默认配置文件
 */

$common = array(
    'consumer_key' => '59566-5831e047a4cf57261d943ca9',
    'mail_host' => 'smtp.163.com',
    'mail_chartset' => 'UTF-8',
    'mail_user' => '',
    'mail_pwd' => '',
    'mail_fromname' => 'Ryan Porket'
);

$online = array();

$dev = array();

return DEBUG ? array_merge($common, $dev) : array_merge($common, $online);