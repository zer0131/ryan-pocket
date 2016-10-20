<?php

namespace controller;

use onefox\Config;
use onefox\Controller;
use onefox\Request;
use onefox\Response;

abstract class Base extends Controller {

    protected $username = '';
    protected $token = '';
    protected $key = '';

    protected function _init() {
        // 校验登录
        $loginData = session('has_login');
        if (!$loginData) {
            if (Request::isAjax()) {
                $this->json(self::CODE_FAIL, 'no login');
            }
            Response::redirect('/passport/login');
        }
        $this->key = Config::get('config.consumer_key');
        $this->token = $loginData['access_token'];
        $this->username = $loginData['username'];
    }

}
