<?php

/**
 * @author ryan<zer0131@vip.qq.com>
 * @desc 默认控制器
 */
namespace controller;

use onefox\ViewController;

class Index extends ViewController  {
    
    /**
     * 默认方法
     */
    public function indexAction(){
        $this->show();
    }
}