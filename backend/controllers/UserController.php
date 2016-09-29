<?php

namespace backend\controllers;

use Yii;
use backend\models\User;
use backend\models\UserSearch;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\components\BaseController;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends BaseController
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $pages = [];
    	$pages['page']     = isset(Yii::$app->request->post()['pageNum']) ? Yii::$app->request->post()['pageNum'] : 1;
    	$pages['pageSize'] = isset(Yii::$app->request->post()['numPerPage'])&&(int)Yii::$app->request->post()['numPerPage'] ? Yii::$app->request->post()['numPerPage'] : 20;
    	 
    	$model = User::find();
    	$pages['count'] = $model->count();
    	 
    	$pages['pageNum'] = ceil($pages['count']/$pages['pageSize']);   	 
    	$data = $model->offset(($pages['page']-1)*$pages['pageSize'])->limit($pages['pageSize'])->all();
    	 
    	return $this->renderAjax('index', [
    			'pages' => $pages,
    			'model' => $data,
    	]);
    }

    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new User();
		
        if ($model->load(Yii::$app->request->post())) {
        	
        	$model->password_hash = Yii::$app->security->generatePasswordHash(Yii::$app->request->post()['User']['password']);
        	$model->auth_key = Yii::$app->security->generateRandomString();
        	if($model->save())
        	{
        		return json_encode([
        			'statusCode'=>'200',
        			'message'=>'操作成功',
        			'navTabId'=>'user_list',
        			'callbackType'=> 'closeCurrent'
        		]);
        	}
        	else 
        	{
        		foreach ($model->getErrors() as $v)
        		{
        			return json_encode(['statusCode'=>"300",'message'=>$v[0],'navTabId'=>'user_list']);
        		}
        	}
        } else {
            return $this->renderAjax('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
		$data = Yii::$app->request->post();
		if($data)
		{
			if ($model->load($data)) {
				if($data['User']['password'])
				{
					$model->password_hash = Yii::$app->security->generatePasswordHash($data['User']['password']);
					$model->auth_key = Yii::$app->security->generateRandomString();
				}
				
				if($model->save())
				{
					return json_encode([
						'statusCode'=>'200',
						'message'=>'操作成功',
						'navTabId'=>'user_list',
						'callbackType'=> 'closeCurrent'
					]);
				}
				else
				{
					foreach ($model->getErrors() as $v)
					{
						return json_encode(['statusCode'=>"300",'message'=>$v[0],'navTabId'=>'user_list']);
					}
				}
			}	
		}
        else 
        {
            return $this->renderAjax('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
    	$model = $this->findModel($id);
    	if($model->delete())
    	{
    		return json_encode([
    			'statusCode'=>'200',
    			'message'=>'操作成功',
    			'navTabId'=>'user_list',
    		]);
    	}
    	else 
    	{
    		return json_encode(['statusCode'=>'300','message'=>'操作失败','navTabId'=>'user_list']);
    	}
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
