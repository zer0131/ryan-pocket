<?php
/**
 * @author ryan<zer0131@vipo.qq.com>
 * @desc 通行证controller
 */

namespace controller;

use onefox\Cache;
use onefox\Config;
use onefox\Controller;
use onefox\Curl;
use onefox\Response;

class Passport extends Controller {

    // 登陆[GET]
    public function loginAction() {
        $this->show();
    }

    // 退出[GET]
    public function logoutAction() {
        dumper('logout');
    }

    // 跳转Pocket中间页[GET]
    public function redirectAction() {
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
                $redirectUri = 'https://getpocket.com/auth/authorize?request_token='.$ret['code'].'&redirect_uri='.$callbackUri;
                Response::redirect($redirectUri);
                break;
            }
            $num--;
        }
        Response::redirect('/');
    }

    // Pocket回调地址[GET]
    public function callbackAction() {
        dumper('callback');
    }
}