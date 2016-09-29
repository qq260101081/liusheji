<?php
namespace backend\controllers;

use Yii;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use yii\web\Controller;
use backend\components\BaseController;

/**
 * Site controller
 */
class SiteController extends BaseController
{

	public function actions()
	{
		return [
			'error' => [
				'class' => 'yii\web\ErrorAction',
			],
		];
	}
	
	
	
    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
    	if (Yii::$app->user->isGuest) {
    		return $this->redirect(['site/login']);
    	}
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
        	
            return $this->goBack();
        } else {
        	
            return $this->renderAjax('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
