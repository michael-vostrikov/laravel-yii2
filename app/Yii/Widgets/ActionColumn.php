<?php

namespace App\Yii\Widgets;

use URL;
use Route;

class ActionColumn extends \yii\grid\ActionColumn
{
    public $keyAttribute = 'id';
    public $baseRoute = null;
    public $separator = '.';

    /**
     * Overrides URL generation to use Laravel routing system
     *
     * @inheritdoc
     */
    public function createUrl($action, $model, $key, $index)
    {
        if (is_callable($this->urlCreator)) {
            return call_user_func($this->urlCreator, $action, $model, $key, $index, $this);
        } else {
            if ($this->baseRoute === null) {
                $this->baseRoute = Route::getCurrentRoute()->getName();
            }

            $baseRouteParts = explode($this->separator, $this->baseRoute);
            $baseRouteParts[count($baseRouteParts) - 1] = $action;
            $route = implode($this->separator, $baseRouteParts);

            $params = is_array($key) ? $key : [$this->keyAttribute => (string) $key];

            return URL::route($route, $params, false);
        }
    }
}
