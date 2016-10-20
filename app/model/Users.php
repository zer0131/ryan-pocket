<?php
/**
 * @author ryan<zer0131@vip.qq.com>
 * @desc 用户model
 */

namespace model;

use onefox\Model;

class Users extends Model {

    protected $table = 'users';

    // 更新或新增
    public function saveOrNewUser($username, $token) {
        return true;
    }

    // 获取用户列表
    public function getUsers() {
        return array();
    }

    public function getUserByAccount($username) {
        return array();
    }

    public function createUser($data) {
        return true;
    }

    public function updateUserById($id, $data) {
        return true;
    }
}