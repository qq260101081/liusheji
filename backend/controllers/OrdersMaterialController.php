<?php

namespace backend\controllers;

use Yii;
use backend\models\OrdersMaterial;
use backend\components\BaseController;
use yii\filters\VerbFilter;
use backend\models\Quality;
use backend\models\Orders;

/**
 * OrdersController implements the CRUD actions for Orders model.
 */
class OrdersMaterialController extends BaseController
{
	
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
     * 原料库存列表
     */
    public function actionIndex()
    {
    	$model = OrdersMaterial::find();
    	$post = Yii::$app->request->post();
    	$type = isset($post['type']) ? $post['type'] : '';
    	if($type) $model->where(['type' => $type]);
    	
		$pages = [];
       	$pages['page']     = isset(Yii::$app->request->post()['pageNum']) ? Yii::$app->request->post()['pageNum'] : 1;
       	$pages['pageSize'] = isset(Yii::$app->request->post()['numPerPage'])&&(int)Yii::$app->request->post()['numPerPage'] ? Yii::$app->request->post()['numPerPage'] : 20;
       	$pages['count']    = $model->count();
       	$pages['pageNum'] = ceil($pages['count']/$pages['pageSize']);
        
       	$data = $model->offset(($pages['page']-1)*$pages['pageSize'])
       		->orderBy('id desc')
       		->limit($pages['pageSize'])
       		->all();
       	
        return $this->renderAjax('index', [
        	'pages' => $pages,
        	'model' => $data,
        	'post'  => $post
        ]);
    }
    /**
     * 原料使用明细
     */
    public function actionLogs($type='', $batch_no='')
    {
    	$model = Orders::find()->where([$type.'_batch_no' => $batch_no])->all();
    	return $this->renderAjax('logs', [
    		'model' => $model,
    		'type' => $type
    	]);
    }
    
    /**
     * 原料下单
     */
    public function actionCreate($tpl='')
    {
        $model = new OrdersMaterial();
        
        if($data = Yii::$app->request->post())
        {        	
	        if ($model->load(['OrdersMaterial'=>$data]) && $model->save()) {
	        	return json_encode(['statusCode'=>'200','navTabId'=>'orders-material_index','callbackType'=>'closeCurrent','message'=>'操作成功']);
	        } else {
	        	foreach ($model->getErrors() as $v)
	        	{
	        		return json_encode(['statusCode'=>"300",'message'=>$v[0]]);	        		 
	        	}
	        }
        }
        else
        {
        	return $this->renderAjax($tpl, [
        		'model' => $model,
        		
        	]);
        }
    }

    /**
     * Finds the Orders model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Orders the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Orders::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
