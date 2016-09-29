<?php
namespace backend\controllers;

use Yii;
use backend\components\BaseController;
use yii\filters\VerbFilter;
use backend\models\AuthItem;
use yii\web\NotFoundHttpException;
use yii\helpers\ArrayHelper;

class RoleController extends BaseController
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
    public function actionIndex()
    {
        $manager = Yii::$app->getAuthManager();
        $model = $manager->getRoles();
        
        return $this->renderAjax("index", [
            "model" => $model
        ]);
    }
    
    public function actionCreate()
    {
    	$model = new AuthItem();
    	
    	if($model->load(Yii::$app->request->post()) && $model->save())
    	{
    		return json_encode([
    			'statusCode'=>'200',
    			'message'=>'操作成功',
    			'navTabId'=>'user_group_list',
    			'callbackType'=> 'closeCurrent'
    		]);
    	}
    	//print_r($model->getErrors());die;
    	return $this->renderAjax("create", [
    		"model" => $model
    	]);
    }
    public function actionUpdate($id)
    {
    	$model = $this->findModel($id);
    	if($model->load(Yii::$app->request->post()) && $model->save())
    	{
    		return json_encode([
    			'statusCode'=>'200',
    			'message'=>'操作成功',
    			'navTabId'=>'user_group_list',
    			'callbackType'=> 'closeCurrent'
    		]);
    	}
    	
    	return $this->renderAjax("update", [
    			"model" => $model
    	]);
    }
    
    public function actionDelete($id)
    {
    	$model = $this->findModel($id);
    	if($model->delete())
    	{
    		return json_encode([
    			'statusCode'=>'200',
    			'message'=>'操作成功',
    			'navTabId'=>'user_group_list',
    		]);
    	}
    	else 
    	{
    		return json_encode(['statusCode'=>'300','message'=>'操作失败','navTabId'=>'user_group_list']);
    	}
    }
    
    
    /**
     * 1.获取所有模块配置的权限(前台模块...怎么办?)
     */
    public function actionPermissions($id)
    {
        $authManager = \Yii::$app->getAuthManager();
        
        if (\Yii::$app->getRequest()->getIsPost())
        {
            $oldPermissions = ArrayHelper::getColumn($authManager->getChildren($id), "name");
            
            $postPermissions = array_keys(\Yii::$app->getRequest()->post("Permissions",[]));
            
            $newChildren = array_diff($postPermissions, $oldPermissions);
            $delChildren = array_diff($oldPermissions,$postPermissions);
            
            $parent = $authManager->getRole($id);
            
            //@hass-todo 这里最好是用sql使用批量删除和添加..但是为了兼容phpmanager
            
            foreach ($delChildren  as $name)
            {
                $authManager->removeChild($parent, $authManager->createPermission($name));
            }
            
            foreach ($newChildren  as $name)
            {
                $authManager->addChild($parent, $authManager->createPermission($name));
            }
            return json_encode(['statusCode'=>'200','message'=>'操作成功','navTabId'=>'quality_unfinished']);
        }
        
        $allPermissions = [];
        $permissions = $authManager->getPermissions(); 
        $groupPermissions = $authManager->getChildren($id);
        //echo "<pre>";
        //print_r($permissions);
        //print_r($groupPermissions);die;
        foreach ($permissions as $k => $v)
        {
        	$arr = explode('/', $k);
        	$allPermissions[$arr[0]][] = $v;
        }
        //echo "<pre>";
        //print_r($allPermissions);die;
        return $this->renderAjax("permissions",[
        	'role' => $authManager->getRole($id),
        	'allPermissions' => $allPermissions,
        	'groupPermissions' => $groupPermissions,
        ]);
    }
    
    protected function findModel($id)
    {
    	if (($model = AuthItem::find()->where(['name' => $id])->one()) !== null) {
    		return $model;
    	} else {
    		throw new NotFoundHttpException('请求页面不存在.');
    	}
    }
}