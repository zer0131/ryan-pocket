<?php
/**
 * @author ryan<zer0131@vipo.qq.com>
 * @desc 通行证controller
 */

namespace controller;

use onefox\Controller;

class Passport extends Controller {

    // 登陆[GET]
    public function loginAction() {
        $this->show();
    }

    // 退出[GET]
    public function logoutAction() {
        dumper('logout');
    }
}