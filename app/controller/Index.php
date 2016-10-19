<?php

/**
 * @author ryan<zer0131@vip.qq.com>
 * @desc 默认控制器
 */
namespace controller;

use onefox\Controller;

class Index extends Controller {

    /**
     * 默认方法
     */
    public function indexAction() {
        $this->show();
    }
}
