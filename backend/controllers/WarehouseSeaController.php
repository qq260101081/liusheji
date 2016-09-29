<?php

namespace backend\controllers;

use Yii;
use backend\models\WarehouseSea;
use backend\models\WarehouseSeaLogTpl;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\components\BaseController;
use backend\models\WarehouseSeaLog;

/**
 * WarehouseSeaController implements the CRUD actions for WarehouseSea model.
 */
class WarehouseSeaController extends BaseController
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
     * Lists all WarehouseSea models.
     * @return mixed
     */
    public function actionIndex()
    {
        $pages = [];
    	$pages['page']     = isset(Yii::$app->request->post()['pageNum']) ? Yii::$app->request->post()['pageNum'] : 1;
    	$pages['pageSize'] = isset(Yii::$app->request->post()['numPerPage'])&&(int)Yii::$app->request->post()['numPerPage'] ? Yii::$app->request->post()['numPerPage'] : 20;
    	 
    	$model = WarehouseSea::find();
    	$pages['count'] = $model->count();
    	 
    	$pages['pageNum'] = ceil($pages['count']/$pages['pageSize']);   	 
    	$data = $model->offset(($pages['page']-1)*$pages['pageSize'])->limit($pages['pageSize'])->all();
    	 
    	return $this->renderAjax('index', [
    			'pages' => $pages,
    			'model' => $data,
    	]);
    }

     /**
     * Creates a new WarehouseSea model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new WarehouseSea();
		$tpl = WarehouseSeaLogTpl::find()->all();
		$data = Yii::$app->request->post();
        if ($data) {
            $data['WarehouseSea']['send_date'] = strtotime($data['WarehouseSea']['send_date']);
            $data['WarehouseSea']['estimated_date'] = strtotime($data['WarehouseSea']['estimated_date']);
            
            if($model->load(['WarehouseSea' => $data['WarehouseSea']]) && $model->save)
            {
            	$rows = [];
            	foreach ($data['WarehouseSeaLog'] as $k => $v)
            	{
            		$rows[$k] = array_merge(['warehouse_sea_id'=>$model->id],$v);
            		 
            	}
            	Yii::$app->db->createCommand()
            		->batchInsert(WarehouseSeaLog::tableName(), [
            				'warehouse_sea_id', 
            				'series',
            				'product_name',
            				'number',
            				'box_number',
            				'code_content',
            				'requirements',
            				'remark'
            		], $rows)
            		->execute();
            	return json_encode(['statusCode'=>'200','navTabId'=>'warehouse_index','callbackType'=>'closeCurrent','message'=>'操作成功']);
            }
            else 
            {
            	foreach ($model->getErrors() as $v)
            	{
            		return json_encode(['statusCode'=>"300",'message'=>$v[0]]);
            	}
            }
        } else {
            return $this->renderAjax('create', [
                'model' => $model,
            	'tpl' => $tpl
            ]);
        }
    }    /**
     * Updates an existing WarehouseSea model.
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
     * Deletes an existing WarehouseSea model.
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
     * Finds the WarehouseSea model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return WarehouseSea the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = WarehouseSea::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
