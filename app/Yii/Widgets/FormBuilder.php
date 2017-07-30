<?php

namespace App\Yii\Widgets;

use yii\widgets\ActiveForm;
use yii\helpers\Html;

/**
 * Form builder
 * Wrapper for ActiveForm component
 */
class FormBuilder extends \yii\base\Component
{
    protected $model;
    protected $form;


    public function __construct($model)
    {
        $this->model = $model;
    }

    public function getModel()
    {
        return $this->model;
    }

    public function setModel($model)
    {
        $this->model = $model;
    }

    public function getForm()
    {
        return $this->form;
    }

    public function open($params = ['successCssClass' => ''])
    {
        $this->form = ActiveForm::begin($params);
    }

    public function close()
    {
        ActiveForm::end();
    }

    public function field($attribute, $options = [])
    {
        return $this->form->field($this->model, $attribute, $options);
    }

    public function submitButton($content, $options = ['class' => 'btn btn-primary'])
    {
        return Html::submitButton($content, $options);
    }
}
