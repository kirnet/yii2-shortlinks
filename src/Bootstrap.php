<?php

namespace kirnet\shortlinks;

use Yii;
use yii\base\BootstrapInterface;

class Bootstrap implements BootstrapInterface
{
    /**
     * @inheritdoc
     */
    public function bootstrap($app)
    {
        $app->getUrlManager()->addRules([
            'shortlinks' => 'shortlinks/short/index',
            'shortlinks/edit' => 'shortlinks/short/edit',
            'shortlinks/view' => 'shortlinks/short/view',
            '/<slug:\w+>' => 'shortlinks/short/redirect'

        ], false);
        $app->setModule('shortlinks', 'kirnet\shortlinks\Module');
    }
}
