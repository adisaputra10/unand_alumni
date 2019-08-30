<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAssetIjazah extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/ijazah/reset.css',
        'css/ijazah/print.css',
        'css/ijazah/pernyataan.css',
        //'css/site.css',
        //'css/eofficestyle.css',
        //'css/eofficestyle_bo.css',
        //'css/bootstrap-treeview.css',
//        'js/chart/css/highcharts.css',
        //'clockpicker/assets/css/bootstrap.min.css',//Untuk Clockpicker Gak Pakai bentrok
        //'clockpicker/dist/bootstrap-clockpicker.min.css'//Untuk Clockpicker
    ];
    public $js = [
        //'js/bootstrap-treeview.js',//Gak Pakai
        //'js/chart/highcharts.js',
        //'clockpicker/dist/bootstrap-clockpicker.min.js'//Untuk Clockpicker
        //'adminlte/js/app.min.js',
    ];
    public $depends = [
        //'yii\web\YiiAsset',
        //'yii\bootstrap\BootstrapAsset',
    ];
}
