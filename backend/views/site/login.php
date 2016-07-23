<?php
use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
$this->title = '美啦啦-后台管理';
$this->registerCssFile('css/login.css');
AppAsset::register($this);
?>
<?php $this->beginPage()?>
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head()?>
</head>
<body>
	<?php $this->beginBody() ?>
	<div class="container-fluid" id="login-page">
    	<div class="row">
        	<div class="col-md-3"></div>
            <div class="col-md-6">
				<?php $form = ActiveForm::begin([
					'id' => 'login-form',
					'options' => ['class'=>'form-horizontal'],
					'fieldConfig' => [
					       'template' => "<div class='col-xs-3 col-sm-2 text-right padding-right'>{label}</div><div class='col-xs-8 col-sm-6'>{input}</div><div class='col-xs-12 col-xs-offset-4 col-sm-4 col-sm-offset-0 padding-left'>{error}</div>",
					]
				]); ?>
				
                <?= $form->field($model, 'username')->textInput(['placeholder'=>'输入登录账户名']);?>
                <?= $form->field($model, 'password')->textInput(['placeholder'=>'输入登录密码']);?>
                <div class="row">
                    <div class="col-md-2"></div>	
                    <div class="col-md-4">
                    <?php echo Html::activeCheckbox($model, 'rememberMe',['id'=>'online'])?>
                    </div>
                    <div class="col-xs-6 col-sm-4">
                        
                        <?=Html::submitButton(' &nbsp;登 &nbsp;&nbsp;&nbsp;录&nbsp; ',['class'=>'btn btn-success btn-big']) ?>
                    </div>   
                </div>  
                <?php ActiveForm::end(); ?>
            </div>
		
        	<div class="col-md-3"></div>
        </div>
	</div>
    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>