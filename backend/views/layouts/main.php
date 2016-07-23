<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use backend\assets\AppAsset;
$this->title = '美啦啦-后台管理';
AppAsset::register($this);

$moduleId = $this->context->module->id;
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title)?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => $this->title,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'nav-diy navbar-inverse navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            //['label' => 'Home', 'url' => ['/site/index']],
        	 '<li>
                <span>管理员：'.Yii::$app->user->identity->username.'</span>
                <a class="btn btn-danger btn-sm" data-method="post" href="'.Yii::$app->urlManager->createUrl(['site/logout']).'">退出登录</a>
             </li>'
        ],
    ]);
    NavBar::end();
    ?>
    
    
    <div class="www-left" data-spy="affix">
        <div class="sidebar-menu">
            <a href="#userMeun" class="nav-header menu-first collapsed Shopping-cart" data-toggle="collapse"><i class="glyphicon glyphicon-shopping-cart"></i> 抢购管理</a>
            <ul id="userMeun" class="nav nav-list collapse menu-second">
                <li><a href="#"><i class="icon-user"></i> 抢购列表</a></li>
                
            </ul>
            <a href="#articleMenu" class="nav-header menu-first collapsed" data-toggle="collapse"><i class="glyphicon glyphicon-screenshot"></i> 医院管理</a>
            <ul id="articleMenu" class="nav nav-list collapse menu-second" <?php if($moduleId == 'hospital') echo 'style="display:block;"'; ?>>
                <li><a href="<?= Yii::$app->urlManager->createUrl(['hospital/hospital/index']) ?>"><i class="icon-pencil"></i> 医院库</a></li>
                
            </ul>
        </div>
    </div>
    <div class="www-content pull-left">
        <?= $content ?>
    </div>
</div>
<span id="top-link-block" class="hidden">
    <a href="#top" class="well well-sm" onclick="$('html,body').animate({scrollTop:0},'slow');return false;">
        <i class="glyphicon glyphicon-arrow-up"></i> Back to Top
    </a>
</span>

<?php
    $js = <<<JS
    if ( ($(window).height() + 100) < $(document).height() ) {
        $('#top-link-block').removeClass('hidden').affix({
            // how far to scroll down before link "slides" into view
            offset: {top:100}
        });
    }
JS;
    $this->registerJs($js);
?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
