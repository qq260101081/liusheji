<?php

namespace backend\modules\hospital\controllers;

use Yii;
use backend\modules\hospital\models\Hospital;
use backend\modules\hospital\models\SearchHospital;
use backend\components\libs;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use backend\components\libs\Common;


/**
 * HospitalController implements the CRUD actions for Hospital model.
 */
class HospitalController extends Controller
{
    /**
     * Lists all Hospital models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SearchHospital();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Hospital model.
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
     * Creates a new Hospital model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Hospital();
        $model->auth = 1;
        $model->nature = 0;

        $province = (new \yii\db\Query())
        ->select(['id','name'])
        ->from('m_province')
        ->indexBy('id')
        ->all();
        
        $data = Yii::$app->request->post();
        if ($data) {
            
            $logoFile = Common::uploadFile('Hospital[logo]');
            if($logoFile) $data['Hospital']['logo'] = $logoFile['path'];
            
            $photoFile = Common::uploadFile('Hospital[photo]');
            if($photoFile) $data['Hospital']['photo'] = $photoFile['path'];
            
            if($model->load($data) && $model->save())
            {
                return $this->redirect(['view', 'id' => $model->id]);
            }
            
        } else {
            return $this->render('create', [
                'model' => $model,
                'province' => $province
            ]);
        }
    }

    /**
     * Updates an existing Hospital model.
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
     * Deletes an existing Hospital model.
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
     * Finds the Hospital model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Hospital the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Hospital::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public function actionChildCity() {
        $out = [];
        if ($name = Yii::$app->request->post()['depdrop_all_params']['hospital-province']) {
            
            $province = (new \yii\db\Query())
            ->select(['id'])
            ->from('m_province')
            ->where(['name'=>$name])
            ->one();
            
            $list = (new \yii\db\Query())
            ->select(['id','name'])
            ->from('m_city')
            ->where(['pro_id'=>$province['id']])
            ->all();
             
            $selected  = null;
            if ($name != null && count($list) > 0) {
                $selected = '';
                foreach ($list as $k => $v) {
                    $out[] = ['id' => $v['name'], 'name' => $v['name']];
                    if ($k == 0) {
                        $selected = $v['name'];
                    }
                }
                // Shows how you can preselect a value
                echo Json::encode(['output' => $out, 'selected'=>$selected]);
                return;
            }
        }
        echo Json::encode(['output' => '', 'selected'=>'']);
    }
}
