<?php
namespace backend\components;

use Yii;
use yii\web\Controller;
use yii\web\User;
use yii\filters\AccessControl;
use common\models\LoginForm;

/**
 * Site controller
 */
class BaseController extends Controller
{	
	public function init(){
		$this->enableCsrfValidation = false;
		
	}
		
	/**
	 * @inheritdoc
	 */
	public function behaviors()
	{
		return [
			'access' => [
				'class' => AccessControl::className(),
				'rules' => [
					[
						'actions' => ['login', 'error'],
						'allow' => true,
					],
					[
						'actions' => ['logout', 'index'],
						'allow' => true,
						'roles' => ['@'],
					],
				],
			],
			/*'rbac' => [
				'class' => AccessControl::className(),
					
			]*/
				
		];
	}
	
	public function beforeAction($action) {
		
		if(Yii::$app->user->isGuest)
		{
			$model = new LoginForm();
			return $this->renderAjax('login', [
				'model' => $model,
			]);
		}
		$allowRoute  = ['orders/get-material']; //不受权限的路由
		$route = \Yii::$app->requestedRoute ? \Yii::$app->requestedRoute : \Yii::$app->defaultRoute . '/index';
		
		if(in_array($route, $allowRoute))
		{
			return true;
		}
		if(Yii::$app->user->can($route))
		{
			return true;
		}
		die('<div style="color:red; padding-top:50px;text-align:center;">您没有权限执行此操作</div>');
	}
	
	
	
}
