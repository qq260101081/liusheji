<?php

namespace backend\controllers;

use Yii;
use backend\models\Menus;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\components\BaseController;

/**
 * MenusController implements the CRUD actions for Menus model.
 */
class MenusController extends BaseController
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
     * Lists all Menus models.
     * @return mixed
     */
    public function actionIndex()
    {
    	$result = Menus::find()->asArray()->indexBy('id')->all();
    	$menus = $this->genTree5($result);
    	//print_r($menus);die;
        return $this->renderAjax('index', [
            'menus' => $menus,
        ]);
    }
    
    private function genTree5($items) 
    { 
    	foreach ($items as $item) 
        	$items[$item['root']]['son'][$item['id']] = &$items[$item['id']]; 
    	return isset($items[0]['son']) ? $items[0]['son'] : []; 
	} 

    /**
     * Displays a single Menus model.
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
     * Creates a new Menus model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($root)
    {
        $model = new Menus();
        if(Yii::$app->getRequest()->getIsPost())
        {
	        if ($model->load(Yii::$app->request->post()) && $model->save()) {
	            return json_encode([
	    			'statusCode'=>'200',
	    			'message'=>'操作成功',
	    			'navTabId'=>'menus_list',
	    			'callbackType'=> 'closeCurrent'
	    		]);
	        }
	        return json_encode(['statusCode'=>'300','message'=>'操作失败','navTabId'=>'menus_list']);
        }else {
        	return $this->renderAjax('create',['root' => $root]);
        }
    }

    /**
     * Updates an existing Menus model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return json_encode([
	    			'statusCode'=>'200',
	    			'message'=>'操作成功',
	    			'navTabId'=>'menus_list',
	    			'callbackType'=> 'closeCurrent'
	    		]);
        } else {
            return $this->renderAjax('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Menus model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if($this->findModel($id)->delete())
        {
        	return json_encode([
        		'statusCode'=>'200',
        		'message'=>'操作成功',
        		'navTabId'=>'menus_list',
        	]);
        }
    }

    /**
     * Finds the Menus model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Menus the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Menus::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
