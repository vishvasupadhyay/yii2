<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset1 extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site1.css',
        'https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css',
    ];

    public $js = [
        'js/site1.js',
        'https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js',
    ];
}
