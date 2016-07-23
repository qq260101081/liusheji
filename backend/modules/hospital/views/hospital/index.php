<?php

use yii\helpers\Html;
use yii\grid\GridView;


/* @var $this yii\web\View */
/* @var $searchModel backend\module\hospital\models\SearchHospital */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '医院管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hospital-index panel panel-success">
    <div class="panel-heading">
        <span><?= Html::encode($this->title)?></span>
        <?= Html::a(' ', ['create'], ['class' => 'glyphicon glyphicon-plus pull-right','title'=>'增加']) ?>
    </div>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'logo',
            'photo',
            'name',
            'nature',
            // 'province',
            // 'city',
            // 'address',
            // 'auth',
            // 'doctor_ids',
            // 'content:ntext',
            // 'create_time',

            ['class' => 'backend\components\grid\ActionColumn'],
                
        ],
    ]); ?>

</div>
