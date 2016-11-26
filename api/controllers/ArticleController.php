<?php
/**
 * Created by 260101081@qq.com
 * User: carl
 * Date: 16/11/25 下午4:56
 */

namespace api\controllers;

use yii\web\Controller;

class ArticleController extends Controller
{
    public $enableCsrfValidation = false;

    public function actionAbout()
    {
        return $this->render('index');
    }
}