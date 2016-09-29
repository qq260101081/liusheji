<?php

namespace backend\controllers;

use Yii;
use backend\models\Quality;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\components\BaseController;
use yii\web\UploadedFile;
use yii\helpers\BaseFileHelper;
use backend\models\Orders;


/**
 * 品质模块
 * QualityController implements the CRUD actions for Quality model.
 */
class QualityController extends BaseController
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
     * 品质-入库申请提醒.
     * @return mixed
     */
    public function actionIndex($complete)
    {
    	$pages = [];
    	$pages['page']     = isset(Yii::$app->request->post()['pageNum']) ? Yii::$app->request->post()['pageNum'] : 1;
    	$pages['pageSize'] = isset(Yii::$app->request->post()['numPerPage'])&&(int)Yii::$app->request->post()['numPerPage'] ? Yii::$app->request->post()['numPerPage'] : 20;
    	
    	$model = Quality::find()->joinWith('orders');
    	
    	if($complete == 'yes')
    	{
    		$model->where(['not', ['quality.username' => null]]);
    		$pages['count'] = $model->count();
    	}
    	else 
    	{
    		$model->where(['quality.username'=>null]);
    		$pages['count'] = $model->count();
    	}
    	
    	$pages['pageNum'] = ceil($pages['count']/$pages['pageSize']);
    	
    	$data = $model->offset(($pages['page']-1)*$pages['pageSize'])->limit($pages['pageSize'])->all();
    	
        return $this->renderAjax('index', [
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
     * 品质-成品入库申请审核（品质负责人
     */
    public function actionUpdate($id)
    {
    	if($data = Yii::$app->request->post())
    	{
    		$qualityModel = $this->findModel($id);
    		$qualityModel->scenario = 'update';
    		$qualityModel->fiels = '';
    		
    		$files = UploadedFile::getInstancesByName('files');
    		if($files)
	    	{
	    		$path = \Yii::getAlias('@upPath') . '/' . date('Ym') . "/";//每月一个文件夹
	    		if(! file_exists($path))
	    		{
	    			BaseFileHelper::createDirectory($path);
	    		}
	    		
	    		foreach ($files as $k=>$v)
	    		{
	    			$files[$k]->saveAs($path . $v->name);
	    			$qualityModel->fiels .= date('Ym').'/'.$v->name . '|';
	    		}
	    		$qualityModel->fiels = rtrim($qualityModel->fiels, '|');
    		}
    		$qualityModel->order_id = $id;
    		$qualityModel->number = $data['number'];
    		$qualityModel->howmany = $data['howmany'];
    		$qualityModel->remark = $data['remark'];
    		$qualityModel->username = Yii::$app->user->identity->username;
    		
    		if($qualityModel->save())
    		{
    			$orderModel = Orders::findOne($id);
    			$orderModel->is_apply = 'yes';
    			if($orderModel->save())
    			{
	    			return json_encode([
	    				'statusCode'=>'200',
	    				'message'=>'操作成功',
	    				'navTabId'=>'quality_unfinished',
	    				'callbackType'=> 'closeCurrent'
	    			]);
    			}
    			else 
    			{
    				return json_encode(['statusCode'=>'300','message'=>'操作失败','navTabId'=>'quality_unfinished']);
    			}
    		}
    		else 
    		{	
    			return json_encode(['statusCode'=>'300','message'=>'操作失败','navTabId'=>'quality_unfinished']);
    		}
	    	
    	}
    	else 
    	{
    		return $this->renderAjax('update',['id'=>$id]);
    	}
    }

    /**
     * Updates an existing Quality model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    

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
        if ($model = Quality::find()->where(['order_id'=>$id])->one()) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
