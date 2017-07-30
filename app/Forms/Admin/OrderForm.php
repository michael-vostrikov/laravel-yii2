<?php

namespace App\Forms\Admin;

use App\Yii\Data\FormModel;

class OrderForm extends FormModel
{
    public function rules()
    {
        return [
           [['user_id'], 'required'],
           [['user_id'], 'integer'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'user.name' => 'User',
        ];
    }
}
