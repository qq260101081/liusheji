<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'default/default.css',
        'default/core.css',
    ];
    public $js = [
        'default/js/jquery-2.1.4.min.js',
        'default/js/dwz.min.js',
        'default/js/dwz.regional.zh.js',
    	'default/js/jquery.validate.min.js',
    	'default/js/dwz.ajax.js',    		
    ];
    public $depends = [
        //'yii\web\YiiAsset',
        //'yii\bootstrap\BootstrapAsset',
    ];
}
