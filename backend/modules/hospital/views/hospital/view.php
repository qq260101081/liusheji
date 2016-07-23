<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\module\hospital\models\Hospital */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Hospitals', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hospital-view panel panel-success">
	<div class="panel-heading"><?= Html::encode($this->title)?></div>
    
    <p>
        <?= Html::a('编辑', ['update', 'id' => $model->id], ['class' => 'btn btn-primary pull-right']) ?>
        <?= Html::a('删除', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger pull-right',
            'data' => [
                'confirm' => '真的要删除吗?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
	<div class="panel-body">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'logo',
            'photo',
            'name',
            'nature',
            'province',
            'city',
            'address',
            'auth',
            'doctor_ids',
            'content:ntext',
            'created_at',
        ],
    ]) ?>
	</div>
</div>
