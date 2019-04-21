<?php

namespace student\assets;

use yii\web\AssetBundle;

/**
 * Main student application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
    ];
    public $js = [

        'js/underscore-min.js',
        'js/ajax.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap4\BootstrapAsset',
        'yii\bootstrap4\BootstrapPluginAsset',
        'yii\jui\JuiAsset'
    ];
}
