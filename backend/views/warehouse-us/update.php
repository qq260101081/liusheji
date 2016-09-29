<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\WarehouseUs */

$this->title = 'Update Warehouse Us: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Warehouse uses', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="warehouse-us-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
