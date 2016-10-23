<?php
/**
 * @author ryan<zer0131@vip.qq.com>
 * @desc 核心api
 */

namespace controller;


use onefox\Curl;
use onefox\Response;

class Api extends Base {

    // 待阅读列表[GET]
    public function to_be_readAction() {
        $url = 'https://getpocket.com/v3/get';
        $params = array(
            'consumer_key' => $this->key,
            'access_token' => $this->token,
            'state' => 'unread'
        );
        $header = array(
            'Content-Type: application/json; charset=UTF-8',
            'X-Accept: application/json'
        );
        $curl = new Curl();
        $num = 3;
        $list = array();
        while ($num > 0) {
            $ret = $curl->post($url, $params, $header, true);
            $ret = json_decode($ret, true);
            if ($ret) {
                $list = $ret['list'];
                break;
            }
            $num--;
        }
        $res = array();
        foreach ($list as $k => $v) {
            $v['origin_url'] = urlencode($v['given_url']);//url参数
            $v['create_time'] = date('Y-m-d H:i:s', $v['time_added']);
            $res[] = $v;
        }
        $this->json(self::CODE_SUCCESS, 'ok', $res);
    }

    // 阅读文章跳转[GET]
    public function readingAction() {
        $itemId = $this->get('item_id');
        $originUrl = urldecode($this->get('origin_url'));
        // 标记文章为已读, 实际操作为构建archive
        $url = 'https://getpocket.com/v3/send';
        $now = time();
        $items = array(
            array(
                'action' => 'archive',
                'item_id' => $itemId,
                'time' => $now
            )
        );
        $params = array(
            'consumer_key' => $this->key,
            'access_token' => $this->token,
            'actions' => $items
        );
        $header = array(
            'Content-Type: application/json; charset=UTF-8',
            'X-Accept: application/json'
        );
        $curl = new Curl();
        $num = 3;
        while ($num > 0) {
            $ret = $curl->post($url, $params, $header, true);
            $ret = json_decode($ret, true);
            if ($ret && $ret['status'] == 1) {
                Response::redirect($originUrl);
                break;
            }
            $num--;
        }
        Response::redirect('/');
    }

    // 获取用户信息[GET]
    public function userinfoAction() {
        $this->json(self::CODE_SUCCESS, 'ok', array('account'=>$this->username));
    }

    // 新增文章[POST]
    public function addAction() {
        //
    }
}