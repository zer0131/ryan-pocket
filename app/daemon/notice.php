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
            $data = $this->_noReadData($v['token']);
            $data && $this->_sendEmail($v['account'], $data);
        }
    }

    // 获取未读文章
    private function _noReadData($token) {
        $url = 'https://getpocket.com/v3/get';
        $key = \onefox\Config::get('config.consumer_key');
        $params = array(
            'consumer_key' => $key,
            'access_token' => $token,
            'state' => 'unread',
            'count' => 10
        );
        $header = array(
            'Content-Type: application/json; charset=UTF-8',
            'X-Accept: application/json'
        );
        $curl = new \onefox\Curl();
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
            $res[] = $v;
        }
        return $res;
    }

    // 发送邮件
    private function _sendEmail($sendTo, $data) {
        // 处理发送内容
        $body = '<ul>';
        foreach ($data as $val) {
            $body .= '<li>';
            $body .= '<a href="'.$val['given_url'].'" target="_blank">'.$val['given_title'].'</a>';
            $body .= '</li>';
        }
        $body .= '</ul>';

        // 邮件发送配置
        $mail = new \PHPMailer\PHPMailer();
        $config = \onefox\Config::get('config');
        $mail->isSMTP();
        $mail->Host = $config['mail_host'];
        $mail->Port = 25;
        $mail->SMTPAuth = true;
        $mail->CharSet = $config['mail_chartset'];//邮件字符集
        $mail->Encoding = 'base64';//邮件编码
        $mail->Username = $config['mail_user'];//邮箱名
        $mail->Password = $config['mail_pwd'];//邮箱密码
        $mail->From = $config['mail_user'];//发件人地址
        $mail->FromName = $config['mail_fromname'];//发件人名称
        $mail->addAddress($sendTo);//收件人
        $mail->Subject = '近期未读文章提醒';//主题
        $mail->msgHTML($body);
        if(!$mail->send()){
            \onefox\C::logError($mail->ErrorInfo);
            return false;
        }
        return true;
    }
}

$obj = new Notice();
$obj->run();