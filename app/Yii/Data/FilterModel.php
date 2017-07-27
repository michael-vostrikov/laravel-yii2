<?php

namespace App\Yii\Data;

use App\Yii\Data\EloquentDataProvider;
use Route;

/**
 * FilterModel is a base model for filter models used in \yii\grid\GridView.
 * It contains array of labels which will be used in \yii\grid\GridView as column labels.
 * FilterModel itself contains no filter fields, you have to inherit and define filter fields in child model.
 */
class FilterModel extends \yii\base\Model
{
    protected $labels;
    protected $rules;
    protected $attributes;


    public function __construct($labels = [], $rules = [])
    {
        parent::__construct();

        $this->labels = $labels;
        $this->rules = $rules;

        $safeAttributes = $this->safeAttributes();
        $this->attributes = array_combine($safeAttributes, array_fill(0, count($safeAttributes), null));
    }

    public function __get($name)
    {
        if (array_key_exists($name, $this->attributes)) {
            return $this->attributes[$name];
        } else {
            return parent::__get($name);
        }
    }

    public function __set($name, $value)
    {
        if (array_key_exists($name, $this->attributes)) {
            $this->attributes[$name] = $value;
        } else {
            parent::__set($name, $value);
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

    public function initDataProvider($query, $sortAttirbutes = [], $route = null)
    {
        if ($route === null) { $route = Route::getCurrentRoute()->uri(); }
        $dataProvider = new EloquentDataProvider([
            'query' => $query,
            'pagination' => ['route' => $route],
            'sort' => ['route' => $route, 'attributes' => $sortAttirbutes],
        ]);

        return $dataProvider;
    }

    public function applyFilter($params)
    {
        $query = null;

        $dataProvider = $this->initDataProvider($query);

        return $dataProvider;
    }
}
