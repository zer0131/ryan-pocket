<?php

/**
 * @author ryan<zer0131@vip.qq.com>
 * @desc 默认控制器
 */
namespace controller;

class Index extends Base {

    /**
     * 默认方法
     */
    public function indexAction() {
        $this->assign('username', $this->username);
        $this->show();
    }
}
