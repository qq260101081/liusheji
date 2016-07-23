<?php

namespace backend\modules\doctor\controllers;

class DoctorController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

}
