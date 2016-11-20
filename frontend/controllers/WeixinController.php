<?php
/**
 * Created by 260101081@qq.com
 * User: carl
 * Date: 16/11/20 下午12:35
 */

namespace frontend\controllers;


use yii\web\Controller;

class WeixinController extends Controller
{
    public function actionIndex($timestamp, $nonce, $signature, $echostr)
    {
        //1.将timestamp, nonce, token 按字典排序
        $array = [$timestamp, $nonce, 'token' => 'yangyan'];
        sort($array);
        //2.将排序后的三个参数拼接之后用sha1加密
        $tmpstr = sha1(implode('', $array));
        //3.将加密后的字符串与signature进行对比，判断该请求是否来自微信
        if($tmpstr == $signature)
        {
            echo $echostr;
            exit;
        }
    }
}