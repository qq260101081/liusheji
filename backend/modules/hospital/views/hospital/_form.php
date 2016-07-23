<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use yii\bootstrap\ActiveForm;
use kartik\file\FileInput;
use \kartik\select2\Select2;
use kartik\depdrop\DepDrop;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model backend\module\hospital\models\Hospital */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="hospital-form">

    <?php $form = ActiveForm::begin(['layout'=>'horizontal','options'=>['enctype'=>'multipart/form-data']]); ?>
    
    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    
    <?= 
        $form->field($model, 'logo')->widget(FileInput::classname(), [
            'options' => [
                'accept' => 'image/*',
            ],
            'pluginOptions' =>[
                'showUpload' => false,
                'showRemove' => false,
                'showPreview' => false,
                'showCaption' => true,
                'allowedFileExtensions'=>['jpg','jpeg','png'],
            ],
            
        ]); 
    ?>
    
    <?= 
        $form->field($model, 'photo')->widget(FileInput::classname(), [
            'options' => [
                'accept' => 'image/*',
            ],
            'pluginOptions' =>[
                'showUpload' => false,
                'showRemove' => false,
                'showPreview' => false,
                'showCaption' => true,
                'allowedFileExtensions'=>['jpg','jpeg','png'],
            ],
            
        ]); 
    ?>

    <?= $form->field($model, 'nature', ['inline'=>true])->radioList(['民营','公立']) ?>
    
    <?=
        $form->field($model, 'province')->widget(Select2::classname(), [
        'options' => ['placeholder' => '请选择省份 ...'],
        'data' => ArrayHelper::map($province, 'name', 'name'),
        
    ]);
     ?> 
    <?= 
    $form->field($model, 'city')->widget(DepDrop::classname(), [
       
        //'options' => ['placeholder' => '请选择城市 ...'],
        'type' => DepDrop::TYPE_SELECT2,
        'select2Options'=>['pluginOptions'=>['allowClear'=>true]],
        'pluginOptions'=>[
            'depends'=>['hospital-province'],
            'url' => Url::to(['hospital/child-city']),
            'loadingText' => '加载中 ...',
        ]
    ]);
    ?>
   

    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'auth', ['inline'=>true])->radioList([1=>'是',0=>'否']) ?>
    

    <?= $form->field($model, 'doctor_ids') ?>
    
    <?= $form->field($model, 'content')->widget('pjkui\kindeditor\Kindeditor',[]) ?>

    <div class="form-group">
        <label class="control-label col-sm-3" for="hospital-content"></label>
        <div class="col-sm-6">
            <?= Html::submitButton($model->isNewRecord ? '<span class=" glyphicon glyphicon-modal-window" aria-hidden="true"></span> 保 存' : '<span class=" glyphicon glyphicon-modal-window" aria-hidden="true"></span> 保 存', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<!-- Modal -->
<div class="modal fade bs-example-modal-lg" id="doctor-list" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">医生库</h4>
      </div>
      <div class="modal-body">
        加载中...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
        <button type="button" class="btn btn-primary">确定</button>
      </div>
    </div>
  </div>
</div>

<?php
    $js = <<<JS
        var options = {};
        $('#hospital-doctor_ids').on('click', function(){
            options.remote = '?r=hospital/hospital/test';
            $('#doctor-list').modal(options);
        });
        
JS;
    //$this->registerJs($js);
?>
