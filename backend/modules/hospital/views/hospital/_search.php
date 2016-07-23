<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\module\hospital\models\SearchHospital */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="hospital-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'logo') ?>

    <?= $form->field($model, 'photo') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'nature') ?>

    <?php // echo $form->field($model, 'province') ?>

    <?php // echo $form->field($model, 'city') ?>

    <?php // echo $form->field($model, 'address') ?>

    <?php // echo $form->field($model, 'auth') ?>

    <?php // echo $form->field($model, 'doctor_ids') ?>

    <?php // echo $form->field($model, 'content') ?>

    <?php // echo $form->field($model, 'create_time') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
