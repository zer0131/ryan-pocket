<?php
/**
 * @author ryan<zer0131@vipo.qq.com>
 * @desc 通行证controller
 */

namespace controller;

use model\Users;
use onefox\Config;
use onefox\Controller;
use onefox\Curl;
use onefox\Response;

class Passport extends Controller {

    // Pocket登陆[GET]
    public function loginAction() {
        $key = Config::get('config.consumer_key');
        $url = 'https://getpocket.com/v3/oauth/request';
        $callbackUri = 'http://123.56.248.154:8906/passport/callback';
        $params = array(
            'consumer_key' => $key,
            'redirect_uri' => $callbackUri
        );
        $header = array(
            'Content-Type: application/json; charset=UTF-8',
            'X-Accept: application/json'
        );
        $curl = new Curl();
        // 重试三次
        $num = 3;
        while ($num > 0) {
            $ret = $curl->post($url, $params, $header, true);
            $ret = json_decode($ret, true);
            if ($ret) {
                // code存入session
                session('pocket_code', $ret['code']);
                $redirectUri = 'https://getpocket.com/auth/authorize?request_token='.$ret['code'].'&redirect_uri='.$callbackUri;
                Response::redirect($redirectUri);
                break;
            }
            $num--;
        }
        Response::redirect('/');
    }

    // 退出[GET]
    public function logoutAction() {
        session(null);
        $this->show();
    }

    // Pocket回调地址[GET]
    public function callbackAction() {
        $code = session('pocket_code');
        $url = 'https://getpocket.com/v3/oauth/authorize';
        $key = Config::get('config.consumer_key');
        $params = array(
            'consumer_key' => $key,
            'code' => $code
        );
        $header = array(
            'Content-Type: application/json; charset=UTF-8',
            'X-Accept: application/json'
        );
        $curl = new Curl();
        // 重试三次
        $num = 3;
        while ($num > 0) {
            $ret = $curl->post($url, $params, $header, true);
            $ret = json_decode($ret, true);
            if ($ret) {
                session('has_login', $ret);
                // 更新或新增用户
                $usersModel = new Users();
                $usersModel->saveOrNewUser($ret['username'], $ret['access_token']);
                Response::redirect('/');
                break;
            }
            $num--;
        }
    }
}