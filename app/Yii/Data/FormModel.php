<?php

namespace App\Yii\Data;

use Illuminate\Database\Eloquent\Model as EloquentModel;

/**
 * FormModel is a base model for models used in \yii\widgets\ActiveForm.
 * It contains array of labels and field validation rules.
 * Validation rules are set in Yii style.
 */
class FormModel extends \yii\base\Model
{
    protected $model;
    protected $labels;
    protected $rules;
    protected $attributes;

    public function __construct(EloquentModel $model, $labels = [], $rules = [])
    {
        parent::__construct();

        $this->model = $model;
        $this->labels = $labels;
        $this->rules = $rules;

        $fillable = $model->getFillable();
        $attributes = [];
        foreach ($fillable as $field) {
            $attributes[$field] = $model->$field;
        }

        $this->attributes = $attributes;
    }

    public function getModel()
    {
        return $model;
    }

    public function __get($name)
    {
        if (array_key_exists($name, $this->attributes)) {
            return $this->attributes[$name];
        } else {
            return $this->model->{$name};
        }
    }

    public function __set($name, $value)
    {
        if (array_key_exists($name, $this->attributes)) {
            $this->attributes[$name] = $value;
        } else {
            $this->model->{$name} = $value;
        }
    }

    public function rules()
    {
        return $this->rules;
    }

    public function attributeLabels()
    {
        return $this->labels;
    }

    public function save()
    {
        if (!$this->validate()) {
            return false;
        }

        $this->model->fill($this->attributes);
        return $this->model->save();
    }
}
