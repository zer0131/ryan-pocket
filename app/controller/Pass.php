<?php
/**
 * @author ryan<zer0131@vip.qq.com>
 * @desc 登陆校验接口controller
 */

namespace controller;

use onefox\ApiController;

class Pass extends ApiController {

    // 校验登陆[POST]
    public function loginAction() {
        $this->json(self::CODE_SUCCESS, 'ok');
    }
}