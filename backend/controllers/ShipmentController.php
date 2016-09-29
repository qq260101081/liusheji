<?php

namespace backend\controllers;

use Yii;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\components\BaseController;
use backend\models\ShipmentArrangement;
use backend\models\Warehouse;
use backend\models\ShipmentReality;


/**
 * QualityController implements the CRUD actions for Quality model.
 */
class ShipmentController extends BaseController
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
     * 准备出货完成/未完成列表.
     * @return mixed
     */
    public function actionArrangementIndex()
    {
    	$model = ShipmentArrangement::find();
    	$post = Yii::$app->request->post();
    	$is_complete = isset($post['is_complete']) ? $post['is_complete'] : '';
    	if($is_complete) $model->where(['is_complete' => $is_complete]);
    	
    	$pages = [];
       	$pages['page']     = isset(Yii::$app->request->post()['pageNum']) ? Yii::$app->request->post()['pageNum'] : 1;
       	$pages['pageSize'] = isset(Yii::$app->request->post()['numPerPage'])&&(int)Yii::$app->request->post()['numPerPage'] ? Yii::$app->request->post()['numPerPage'] : 20;
       	$pages['count']    = $model->count();
       	$pages['pageNum'] = ceil($pages['count']/$pages['pageSize']);    		     	
       	
       	
      	$data = $model->offset(($pages['page']-1)*$pages['pageSize'])
       	->limit($pages['pageSize'])
       	->all();
       	
        return $this->renderAjax('arrangement-index', [
        	'pages' => $pages,
        	'model' => $data,
        	'post'  => $post
        ]);
    	
    }
    
    /**
     * 实际出货完成/未完成.
     * @return mixed
     */
    public function actionRealityIndex($complete)
    {
    	$model = ShipmentReality::find();
    	$pages = [];
    	$pages['page']     = isset(Yii::$app->request->post()['pageNum']) ? Yii::$app->request->post()['pageNum'] : 1;
    	$pages['pageSize'] = isset(Yii::$app->request->post()['numPerPage'])&&(int)Yii::$app->request->post()['numPerPage'] ? Yii::$app->request->post()['numPerPage'] : 20;   	
    
    	if($complete == 'yes')   	
    		$model->where(['not', ['reality_username' => null]]);
    	else 
    		$model->where(['reality_username' => null]);
    	
    	$pages['count'] = $model->count();
    	$pages['pageNum'] = ceil($pages['count']/$pages['pageSize']);
    	
    	$data = $model->offset(($pages['page']-1)*$pages['pageSize'])
    		->limit($pages['pageSize'])
    		->all();
    
    	return $this->renderAjax('reality-index', [
    			'pages' => $pages,
    			'model' => $data,
    	]);
    	 
    }

    /**
     * Displays a single Quality model.
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
     * Creates a new Quality model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    
    /**
     * 
     * 出货-出货安排
     */
    public function actionArrangementCreate()
    {
    	if($data = Yii::$app->request->post())
    	{
    		$warehouseModel = Warehouse::find()->where(['product_name' => $data['product_name']])->one();
    		//检查是否仓库有足够的库存
    		if($warehouseModel && $warehouseModel->number >= $data['number'])
    		{
    			$model = new ShipmentArrangement();
		        if ($model->load(['ShipmentArrangement'=>$data]) && $model->save()) {
		        	//插入到实际出货表（提醒出货
		        	$shipRealityModel = new ShipmentReality();
		        	$shipRealityModel->scenario = 'create';
		        	$shipRealityModel->shipment_id = $model->id;
		        	$shipRealityModel->product_name = $model->product_name;
		        	$shipRealityModel->number = $model->number;
		        	$shipRealityModel->shipping_address = $model->shipping_address;
		        	$shipRealityModel->ship_type = $model->ship_type;
		        	$shipRealityModel->ask_remark = $model->ask_remark;
		        	$shipRealityModel->created_at = time();
		        	if($shipRealityModel->save())
		        	{
		        		return json_encode(['statusCode'=>'200','navTabId'=>'arrangement_index','callbackType'=>'closeCurrent','message'=>'操作成功']);
		        		
		        	}
		        	foreach ($model->getErrors() as $v)
		        	{
		        		return json_encode(['statusCode'=>"300",'message'=>$v[0]]);
		        	}
	    			
		        } else {
		        	foreach ($model->getErrors() as $v)
		        	{
		        		return json_encode(['statusCode'=>"300",'message'=>$v[0]]);	        		 
		        	}
		        }
    		}
    		else 
    		{
    			return json_encode(['statusCode'=>"300",'message'=>'库存不足，无法出货']);
    		}
    	}
    	else 
    	{  
    		$warehouseModel = Warehouse::find()->all();
    		return $this->renderAjax('arrangement-create', ['warehouseModel' => $warehouseModel]);
    	}
    }
    
    /**
     * 出货-确认出货
     */
    public function actionRealityShipment($id)
    {
    	$model = ShipmentReality::find()->where(['shipment_id' => $id])->one();
    	
    	if($data = Yii::$app->request->post())
    	{
    		$model->scenario = 'update';
    		//检查库存是否够
    		$warehouse = Warehouse::find()
    			->select(['id','number'])
    			->where(['product_name' => $model->product_name])
    			->andWhere(['type'=>'zh'])
    			->one();
    		if($warehouse->number < $model->number)
    		{
    			return json_encode(['statusCode'=>"300",'message'=>'产品库存不足！']);
    		}
    		$data['reality_username'] = Yii::$app->user->identity->username;
    		if ($model->load(['ShipmentReality'=>$data]) && $model->save()) 
    		{
    			//扣除库存
    			$warehouse->type = 'zh';
    			$warehouse->number -= $model->number;
    			$warehouse->save();
    			//更新出货安排状态
    			$shipmentArrangement = ShipmentArrangement::find()->where(['id' => $id])->one();
    			$shipmentArrangement->is_complete = 'yes';
    			$shipmentArrangement->save();
    			
    			return json_encode([
    				'statusCode'=>'200',
    				'message'=>'操作成功',
    				'navTabId'=>'reality_index',
    				'callbackType'=> 'closeCurrent'
    			]);
    		}
    		return json_encode(['statusCode'=>"300",'message'=>'操作失败！']);
    	}
    	else 
    	{
    		return $this->renderAjax('shipment-reality', ['model' => $model]);
    	}
    }
    
    
    /**
     * Updates an existing Quality model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->order_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Quality model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Quality model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Quality the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (!$model = ShipmentArrangement::find()->where(['order_id'=>$id])->one()) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
