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
        $info = $this->getUserByAccount($username);
        if ($info) {
            return $this->updateUserById($info['id'], array('token' => $token));
        }
        $newData = array(
            'account' => $username,
            'token' => $token
        );
        return $this->insert($newData);
    }

    // 获取用户列表
    public function getUsers() {
        $sql = "select * from $this->table";
        return $this->db->query($sql);
    }

    public function getUserByAccount($username) {
        $sql = "select * from $this->table where account=:account";
        $map['account'] = $username;
        return $this->db->row($sql, $map);
    }

    public function updateUserById($id, $data) {
        $map['id'] = $id;
        $sql = $this->genUpdateSql($data, $map);
        return $this->db->query($sql, $map);
    }
}