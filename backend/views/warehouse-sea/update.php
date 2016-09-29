<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\WarehouseSea */

$this->title = 'Update Warehouse Sea: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Warehouse Seas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="warehouse-sea-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
