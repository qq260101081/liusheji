<?php

namespace backend\controllers;

use Yii;
use backend\models\Files;
use backend\models\FilesSearch;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use backend\components\BaseController;
use yii\helpers\BaseFileHelper;

/**
 * FilesController implements the CRUD actions for Files model.
 */
class FilesController extends BaseController
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
     * 下单模块文档列表
     */
    public function actionOrderIndex()
    {
    	$model = Files::find()->where( ['category' => 'order']);
    	$pages = [];
    	$pages['page']     = isset(Yii::$app->request->post()['pageNum']) ? Yii::$app->request->post()['pageNum'] : 1;
    	$pages['pageSize'] = isset(Yii::$app->request->post()['numPerPage'])&&(int)Yii::$app->request->post()['numPerPage'] ? Yii::$app->request->post()['numPerPage'] : 20;
    	$pages['count']    = $model->count();
    	$pages['pageNum'] = ceil($pages['count']/$pages['pageSize']);
    	
    	$data = $model->offset(($pages['page']-1)*$pages['pageSize'])
    		->limit($pages['pageSize'])
    		->all();
    
    	return $this->renderAjax('index', [
    			'pages' => $pages,
    			'model' => $data,
    	]);
    }
    /**
     * 品质模块文档列表
     */
    public function actionQualityIndex()
    {
    	$model = Files::find()->where( ['category' => 'quality']);
    	$pages = [];
    	$pages['page']     = isset(Yii::$app->request->post()['pageNum']) ? Yii::$app->request->post()['pageNum'] : 1;
    	$pages['pageSize'] = isset(Yii::$app->request->post()['numPerPage'])&&(int)Yii::$app->request->post()['numPerPage'] ? Yii::$app->request->post()['numPerPage'] : 20;
    	$pages['count']    = $model->count();
    	$pages['pageNum'] = ceil($pages['count']/$pages['pageSize']);
    	 
    	$data = $model->offset(($pages['page']-1)*$pages['pageSize'])
    	->limit($pages['pageSize'])
    	->all();
    
    	return $this->renderAjax('index', [
    			'pages' => $pages,
    			'model' => $data,
    	]);
    }
    /**
     * 仓库模块文档列表
     */
    public function actionWarehouseIndex()
    {
    	$model = Files::find()->where( ['category' => 'warehouse']);
    	$pages = [];
    	$pages['page']     = isset(Yii::$app->request->post()['pageNum']) ? Yii::$app->request->post()['pageNum'] : 1;
    	$pages['pageSize'] = isset(Yii::$app->request->post()['numPerPage'])&&(int)Yii::$app->request->post()['numPerPage'] ? Yii::$app->request->post()['numPerPage'] : 20;
    	$pages['count']    = $model->count();
    	$pages['pageNum'] = ceil($pages['count']/$pages['pageSize']);
    
    	$data = $model->offset(($pages['page']-1)*$pages['pageSize'])
    	->limit($pages['pageSize'])
    	->all();
    
    	return $this->renderAjax('index', [
    			'pages' => $pages,
    			'model' => $data,
    	]);
    }
    /**
     * 出货模块文档列表
     */
    public function actionShipmentIndex()
    {
    	$model = Files::find()->where( ['category' => 'shipment']);
    	$pages = [];
    	$pages['page']     = isset(Yii::$app->request->post()['pageNum']) ? Yii::$app->request->post()['pageNum'] : 1;
    	$pages['pageSize'] = isset(Yii::$app->request->post()['numPerPage'])&&(int)Yii::$app->request->post()['numPerPage'] ? Yii::$app->request->post()['numPerPage'] : 20;
    	$pages['count']    = $model->count();
    	$pages['pageNum'] = ceil($pages['count']/$pages['pageSize']);
    
    	$data = $model->offset(($pages['page']-1)*$pages['pageSize'])
    	->limit($pages['pageSize'])
    	->all();
    
    	return $this->renderAjax('index', [
    			'pages' => $pages,
    			'model' => $data,
    	]);
    }
    /**
     * 财务模块文档列表
     */
    public function actionFinanceIndex()
    {
    	$model = Files::find()->where( ['category' => 'finance']);
    	$pages = [];
    	$pages['page']     = isset(Yii::$app->request->post()['pageNum']) ? Yii::$app->request->post()['pageNum'] : 1;
    	$pages['pageSize'] = isset(Yii::$app->request->post()['numPerPage'])&&(int)Yii::$app->request->post()['numPerPage'] ? Yii::$app->request->post()['numPerPage'] : 20;
    	$pages['count']    = $model->count();
    	$pages['pageNum'] = ceil($pages['count']/$pages['pageSize']);
    
    	$data = $model->offset(($pages['page']-1)*$pages['pageSize'])
    	->limit($pages['pageSize'])
    	->all();
    
    	return $this->renderAjax('index', [
    			'pages' => $pages,
    			'model' => $data,
    	]);
    }
    /**
     * 经理模块文档列表
     */
    public function actionManagerIndex()
    {
    	$model = Files::find()->where( ['category' => 'manager']);
    	$pages = [];
    	$pages['page']     = isset(Yii::$app->request->post()['pageNum']) ? Yii::$app->request->post()['pageNum'] : 1;
    	$pages['pageSize'] = isset(Yii::$app->request->post()['numPerPage'])&&(int)Yii::$app->request->post()['numPerPage'] ? Yii::$app->request->post()['numPerPage'] : 20;
    	$pages['count']    = $model->count();
    	$pages['pageNum'] = ceil($pages['count']/$pages['pageSize']);
    
    	$data = $model->offset(($pages['page']-1)*$pages['pageSize'])
    	->limit($pages['pageSize'])
    	->all();
    
    	return $this->renderAjax('index', [
    			'pages' => $pages,
    			'model' => $data,
    	]);
    }
    /**
     * Displays a single Files model.
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
     * Creates a new Files model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Files();
        $data = Yii::$app->request->post();
        if($data)
        {
	        $files = UploadedFile::getInstanceByName('files');
	       
	        if($files)
	        {
	        	$path = \Yii::getAlias('@webroot') . '/upload/' . date('Ym') . "/";//每月一个文件夹
	        	if(! file_exists($path))
	        	{
	        		BaseFileHelper::createDirectory($path);
	        	}
	        	
	        	$fileName = date("YmdHis") . '_' . rand(10000, 99999).'.'.$files->getExtension();
	        	if($files->saveAs($path .$fileName))
	        	{
	        		$model->load($data);
	        		$model->path = date('Ym').'/'.$fileName;
	        		$model->username = Yii::$app->user->identity->username;
	        		
	        		if($model->save())
	        		{
	        			return json_encode([
	        				'statusCode'=>'200',
	        				'message'=>'操作成功',
	        				'navTabId'=>'files_list',
	        				'callbackType'=> 'closeCurrent'
	        			]);
	        		}
	        		else 
	        		{
	        			return json_encode(['statusCode'=>'300','message'=>'操作失败，数据保存失败','navTabId'=>'files_add']);
	        		}
	        	}
	        	else 
	        	{
	        		return json_encode(['statusCode'=>'300','message'=>'操作失败,文件保存失败','navTabId'=>'files_add']);
	        	}
	        }
        }
        else 
        {
        	return $this->renderAjax('create');
        }
    }

    /**
     * Updates an existing Files model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Files model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
    	$model = $this->findModel($id);
        if($model->delete())
        {
        	@unlink(\Yii::getAlias('@webroot') . '/upload/'.$model->path);
        	return json_encode([
        		'statusCode'=>'200',
        		'message'=>'操作成功',
        		'navTabId'=>'files_list',
        	]);
        }
        else
        {
        	return json_encode(['statusCode'=>'300','message'=>'操作失败','navTabId'=>'files_list']);
        }
    }

    /**
     * Finds the Files model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Files the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Files::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
