<?php

namespace backend\controllers;

use Yii;
use backend\models\Orders;
use backend\models\OrdersMaterial;
use backend\components\BaseController;
use yii\filters\VerbFilter;
use backend\models\Quality;
use backend\models\Category;
use yii\web\NotFoundHttpException;


/**
 * OrdersController implements the CRUD actions for Orders model.
 */
class OrdersController extends BaseController
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
	
	public function actionExport()
	{
		$excel = new Excel();
		$data = array(
				array('姓名','标题','文章','价格','数据5','数据6','数据7'),
				array('数据1','数据2','数据3','数据4','数据5','数据6','数据7'),
				array('数据1','数据2','数据3','数据4','数据5','数据6','数据7'),
				array('数据1','数据2','数据3','数据4','数据5','数据6','数据7'),
				array('数据1','数据2','数据3','数据4','数据5','数据6','数据7'),
				array('数据1','数据2','数据3','数据4','数据5','数据6','数据7')
		);
		
		$excel->download($data, '这是一个测试');
	}
	
	/**
	 * 下单查找带回原料批号
	 */
	public function actionGetMaterial($type='')
	{
		$model = OrdersMaterial::find();
    	$post = Yii::$app->request->post();
    	$post['type'] = $type = isset($post['type']) ? $post['type'] : $type;
    	if($type) $model->where(['type' => $type]);
    	
		$pages = [];
       	$pages['page']     = isset(Yii::$app->request->post()['pageNum']) ? Yii::$app->request->post()['pageNum'] : 1;
       	$pages['pageSize'] = isset(Yii::$app->request->post()['numPerPage'])&&(int)Yii::$app->request->post()['numPerPage'] ? Yii::$app->request->post()['numPerPage'] : 20;
       	$pages['count']    = $model->count();
       	$pages['pageNum'] = ceil($pages['count']/$pages['pageSize']);
        //$model = Orders::find()->joinWith('quality')->on(['id'=>'quality.order_id'])->offset(($pages['page']-1)*$pages['pageSize'])->limit($pages['pageSize'])->all();
       	
       		//$sql = 'select * from ' . Orders::tableName() . " where (ck_qt_user is not null and ck_sh_user is not null and order_type='order')
      		//		 or (order_type='shipment' and ck_qt_user is not null)";
      		
       	$data = $model->offset(($pages['page']-1)*$pages['pageSize'])
       		->limit($pages['pageSize'])
       		->all();
       	
        return $this->renderAjax('get_material', [
        	'pages' => $pages,
        	'model' => $data,
        	'post'  => $post
        ]);
	}
    
    /**
     * 成品订单列表
     */
    public function actionIndex()
    {
    	$model = Orders::find();
    	$post = Yii::$app->request->post();
    	$is_apply = isset($post['is_apply']) ? $post['is_apply'] : '';
    	if($is_apply) $model->where(['is_apply' => $is_apply]);
    	
		$pages = [];
       	$pages['page']     = isset(Yii::$app->request->post()['pageNum']) ? Yii::$app->request->post()['pageNum'] : 1;
       	$pages['pageSize'] = isset(Yii::$app->request->post()['numPerPage'])&&(int)Yii::$app->request->post()['numPerPage'] ? Yii::$app->request->post()['numPerPage'] : 20;
       	$pages['count']    = $model->count();
       	$pages['pageNum'] = ceil($pages['count']/$pages['pageSize']);
        //$model = Orders::find()->joinWith('quality')->on(['id'=>'quality.order_id'])->offset(($pages['page']-1)*$pages['pageSize'])->limit($pages['pageSize'])->all();
       	
       		//$sql = 'select * from ' . Orders::tableName() . " where (ck_qt_user is not null and ck_sh_user is not null and order_type='order')
      		//		 or (order_type='shipment' and ck_qt_user is not null)";
      		
       	$data = $model->offset(($pages['page']-1)*$pages['pageSize'])
       		->limit($pages['pageSize'])
       		->all();
       	
        return $this->renderAjax('index', [
        	'pages' => $pages,
        	'model' => $data,
        	'post'  => $post
        ]);
    }
    
    /**
     * 成品申请入库（提醒品质验货
     */

    public function actionApplyStorage($id)
    {
    	$model = $this->findModel($id);
    	$qualityModel = new Quality();
    	$qualityModel->scenario = 'create';
    	$qualityModel->order_id = $id;
    	if($qualityModel->save())
    	{
    		$model->is_apply = 'yes';
    		$model->save();
    		return json_encode([
    			'statusCode'=>'200',
    			'message'=>'操作成功',
    			'navTabId'=>'orders_index',
    		]);
    	}
    	else 
    	{
    		foreach ($qualityModel->getErrors() as $v)
    		{
    			return json_encode(['statusCode'=>"300",'message'=>$v[0]]);
    		}
    	}
    }
    

    /**
     * 成品下单
     */
    public function actionCreate()
    {
        $model = new Orders();
        $category = Category::find()
        	->select(['id','product','lamp','lamp_number','ic','ic_number'])
        	->orderBy('product')
        	->indexBy('product')
        	->asArray()
        	->all();
        if($data = Yii::$app->request->post())
        {
        	//检查原料是否有IC或灯珠库存
        	if($data['ic'])
        	{
        		if(!$data['ic_batch_no'] || !$data['ic_number'])
        		{
        			return json_encode(['statusCode'=>"300",'message'=>'IC批号或数量不能为空']);
        		}
        		$materialIc = OrdersMaterial::find()
        			->select(['id','type','number'])
        			->where(['batch_no'=>$data['ic_batch_no']])
        			->andWhere(['type' => 'ic'])
        			->one();
        		if($materialIc->number < (int)$data['ic_number'])
        		{
        			return json_encode(['statusCode'=>"300",'message'=>'IC数量库存不足']);
        		}
        		$materialIc->number -= (int)$data['ic_number'];
        	}
        	if($data['lamp'])
        	{
        		if(!$data['lamp_batch_no'] || !$data['lamp_number'])
        		{
        			return json_encode(['statusCode'=>"300",'message'=>'灯珠批号或数量不能为空']);
        		}
        		
        		$materialLamp = OrdersMaterial::find()
        			->select(['id','type','number'])
        			->where(['batch_no'=>$data['lamp_batch_no']])
        			->andWhere(['type' => 'lamp'])
        			->one();
        		
        		if($materialLamp->number < (int)$data['lamp_number'])
        		{
        			return json_encode(['statusCode'=>"300",'message'=>'灯珠数量库存不足']);
        		}
        		$materialLamp->number -= (int)$data['lamp_number'];
        	}
        	
        	
        	$data['total_price'] = $data['unit_price'] * $data['number'];
        	$data['username'] = Yii::$app->user->identity->username;
        	
	        if ($model->load(['Orders'=>$data]) && $model->save()) {
	        	isset($materialIc)&&$materialIc->save();
	        	isset($materialLamp)&&$materialLamp->save();
	        	return json_encode(['statusCode'=>'200','navTabId'=>'orders_index','callbackType'=>'closeCurrent','message'=>'操作成功']);
	        } else {
	        	foreach ($model->getErrors() as $v)
	        	{
	        		return json_encode(['statusCode'=>"300",'message'=>$v[0]]);	        		 
	        	}
	        }
        }
        else
        {
        	return $this->renderAjax('create', [
        		'model' => $model,
        		'category' => $category
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
