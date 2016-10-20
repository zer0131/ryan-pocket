<?php
/**
 * @author ryan<zer0131@vip.qq.com>
 * @desc 邮件推送待阅读文章脚本
 */

set_time_limit(0);
require __DIR__ . DIRECTORY_SEPARATOR . 'loader.php';

class Notice {

    public function run() {
        $usersModel = new \model\Users();
        $userList = $usersModel->getUsers();
        if (!$userList) {
            exit;
        }
        foreach ($userList as $k => $v) {
            $data = $this->_noReadData($v['account'], $v['token']);
            $data && $this->_sendEmail($data);
        }
    }

    private function _noReadData($username, $token) {
        return array();
    }

    private function _sendEmail($data) {
        //
    }
}

$obj = new Notice();
$obj->run();