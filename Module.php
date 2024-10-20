<?php

namespace soless\catalogue;

class Module extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'soless\catalogue\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        if (\Yii::$app instanceof \yii\console\Application) {
            $this->controllerNamespace = 'soless\catalogue\commands';
        }

        // custom initialization code goes here
    }
}
