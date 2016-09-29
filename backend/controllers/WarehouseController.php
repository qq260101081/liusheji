<?php

namespace backend\controllers;

use Yii;
use backend\models\Warehouse;
use backend\models\WarehouseSearch;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\components\BaseController;
use backend\models\Quality;
use backend\models\Orders;
use backend\models\Category;


/**
 * WarehouseController implements the CRUD actions for Warehouse model.
 */
class WarehouseController extends BaseController
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
     * Lists all Warehouse models.
     * @return mixed
     */
    
    /**
     * 仓库库存列表(国内
     * @return mixed
     */
    public function actionIndex()
    {
    	$pages = [];
    	$pages['page']     = isset(Yii::$app->request->post()['pageNum']) ? Yii::$app->request->post()['pageNum'] : 1;
    	$pages['pageSize'] = isset(Yii::$app->request->post()['numPerPage'])&&(int)Yii::$app->request->post()['numPerPage'] ? Yii::$app->request->post()['numPerPage'] : 20;
    	 
    	$model = Warehouse::find();
    	$pages['count'] = $model->count();
    	 
    	$pages['pageNum'] = ceil($pages['count']/$pages['pageSize']);   	 
    	$data = $model->offset(($pages['page']-1)*$pages['pageSize'])->limit($pages['pageSize'])->all();
    	 
    	return $this->renderAjax('index', [
    			'pages' => $pages,
    			'model' => $data,
    	]);
    }
    
    
    /**
     * 仓库-入库申请提醒列表.
     * @return mixed
     */
    public function actionOrderIndex($complete)
    {
        $pages = [];
    	$pages['page']     = isset(Yii::$app->request->post()['pageNum']) ? Yii::$app->request->post()['pageNum'] : 1;
    	$pages['pageSize'] = isset(Yii::$app->request->post()['numPerPage'])&&(int)Yii::$app->request->post()['numPerPage'] ? Yii::$app->request->post()['numPerPage'] : 20;
    	
    	$model = Quality::find()->joinWith('orders');
    	
    	if($complete == 'yes')
    	{
    		$model->where(['not', ['quality.warehouse_username' => null]])->andWhere(['not',['quality.username'=>null]]);
    	}
    	else 
    	{
    		$model->where(['quality.warehouse_username'=>null])->andWhere(['not',['quality.username'=>null]]);
    	}
    	
    	$pages['count'] = $model->count();
    	$pages['pageNum'] = ceil($pages['count']/$pages['pageSize']);
    	
    	$data = $model->offset(($pages['page']-1)*$pages['pageSize'])->limit($pages['pageSize'])->all();
    	
        return $this->renderAjax('order-index', [
    		'pages' => $pages,
    		'model' => $data,
    	]);
    }
    
    /**
     * 仓库-审核品质过来的订单提醒
     * 
     */
    public function actionUpdateOrder($id)
    {
    	$qualityModel = Quality::find()->where(['order_id' => $id])->one();
    	$qualityModel->scenario = 'update';
    	$qualityModel->warehouse_username = Yii::$app->user->identity->username;
    	if($qualityModel->save())
    	{
    		//查询对应的订单信息
    		$orderModel = Orders::find()->select(['product_name'])->where(['id' => $qualityModel->order_id])->one();
    		//检查仓库是否有库存
    		$model = Warehouse::find()->select(['id','number'])
    			->where(['product_name'=>$orderModel->product_name])
    			->one();
    		//有则更新没有则插入
    		if(!$model)
    		{
    			$model = new Warehouse();
    			$model->product_name = $orderModel->product_name;
    			$model->number = $qualityModel->number;
    		}
    		else 
    		{
    			$model->number += $qualityModel->number;
    		}
    		
    		if($model->save())
    		{
    			return json_encode([
    				'statusCode'=>'200',
    				'message'=>'操作成功',
    				'navTabId'=>'warehouse_order_index',
    				'callbackType'=> 'closeCurrent'
    			]);
    		}
    		foreach ($qualityModel->getErrors() as $v)
    		{
    			return json_encode(['statusCode'=>"300",'message'=>$v[0]]);
    		}
    	}
    	else
    	{
    		foreach ($qualityModel->getErrors() as $v)
    		{
    			return json_encode(['statusCode'=>"300",'message'=>$v[0]]);
    		}
    	}
    }

    protected function findModel($id)
    {
        if (($model = Warehouse::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('您请求的页面不存在.');
        }
    }
}
