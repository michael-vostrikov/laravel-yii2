<?php

namespace App\Yii\Web;

class View extends \yii\web\View
{
    public function getHeadHtml()
    {
        return parent::renderHeadHtml();
    }

    public function getBodyBeginHtml()
    {
        return parent::renderBodyBeginHtml();
    }

    public function getBodyEndHtml($ajaxMode = false)
    {
        return parent::renderBodyEndHtml($ajaxMode);
    }

    public function initAssets()
    {
        \yii\web\YiiAsset::register($this);

        ob_start();

        $this->beginBody();
        $this->endBody();

        ob_get_clean();
    }
}
