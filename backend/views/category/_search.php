<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\CategorySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="category-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'series') ?>

    <?= $form->field($model, 'product') ?>

    <?= $form->field($model, 'abbreviation') ?>

    <?= $form->field($model, 'lamp') ?>

    <?php // echo $form->field($model, 'lamp_number') ?>

    <?php // echo $form->field($model, 'ic') ?>

    <?php // echo $form->field($model, 'ic_number') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
