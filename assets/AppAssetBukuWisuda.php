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
class AppAssetBukuWisuda extends AssetBundle {

    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'plugins/turnjs4/css/basic.css',
    ];
    public $js = [
        'plugins/turnjs4/extras/jquery.min.1.7.js',
        'plugins/turnjs4/extras/modernizr.2.5.3.min.js',
        'plugins/turnjs4/js/basic.js',
        'plugins/turnjs4/lib/turn.html4.min.js',
        'plugins/turnjs4/lib/turn.js'
    ];
    public $depends = [
            //'yii\web\YiiAsset',
            //'yii\bootstrap\BootstrapAsset',
    ];

}
