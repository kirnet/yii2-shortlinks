<?php

namespace kirnet\shortlinks;

use yii\web\AssetBundle;

class ShortAssetsBundle extends AssetBundle
{
    public $sourcePath = '@vendor/kirnet/yii2-shortlinks/assets';

    public $js = [
        'js/shortlinks.js'
    ];

    public $depends = [
        'yii\web\JqueryAsset',
        'yii\jui\JuiAsset'
    ];
}