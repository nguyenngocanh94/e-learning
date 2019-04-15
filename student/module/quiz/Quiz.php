<?php

namespace student\module\quiz;

use yii\base\BootstrapInterface;
use yii\base\Module;

/**
 * matching module definition class
 */
class Quiz extends Module implements BootstrapInterface
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'student\module\quiz\controllers';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }

    /**
     * @inheritdoc
     */
    public function bootstrap($app)
    {
        $app->getUrlManager()->addRules([
            [
                'class' => 'yii\web\UrlRule',
                'pattern' => $this->id,
                'route' => $this->id . '/tools/index'
            ],
            [
                'class' => 'yii\web\UrlRule',
                'pattern' => $this->id . '/<controller:[\w\-]+>/<action:[\w\-]+>',
                'route' => $this->id . 'create'/'<action>'
            ],
        ], false);
    }
}
