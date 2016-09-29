<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\WarehouseUs */

$this->title = 'Create Warehouse Us';
$this->params['breadcrumbs'][] = ['label' => 'Warehouse uses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="warehouse-us-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
