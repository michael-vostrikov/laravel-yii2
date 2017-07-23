<?php

namespace App\Yii\Web;

use Session;

class Request extends \yii\web\Request
{
    /**
     * Overrides getter for CSRF token to use Laravel token
     * Regeneration is not used for compatibility
     *
     * @inheritdoc
     */
    public function getCsrfToken($regenerate = false)
    {
        return Session::token();
    }
}
