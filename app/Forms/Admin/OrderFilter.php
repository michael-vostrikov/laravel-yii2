<?php

namespace App\Forms\Admin;

use App\Yii\Data\FilterModel;

class OrderFilter extends FilterModel
{
    public function rules()
    {
        return [
            ['id', 'safe'],
            ['user.name', 'safe'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'user.name' => 'User',
        ];
    }

    public function applyFilter($params)
    {
        $this->load($params);

        $query = \App\Models\Order::query();
        $query->join('users', 'users.id', '=', 'orders.user_id')->select('orders.*');

        if ($this->id) $query->where('orders.id', '=', $this->id);
        if ($this->{'user.name'}) $query->where('users.name', 'like', '%'.$this->{'user.name'}.'%');

        $sortAttributes = [
            'id',
            'user.name' => ['asc' => ['users.name' => SORT_ASC], 'desc' => ['users.name' => SORT_DESC]],
        ];

        $dataProvider = $this->initDataProvider($query, $sortAttributes);
        $dataProvider->pagination->defaultPageSize = 10;

        if (empty($dataProvider->sort->getAttributeOrders())) {
            $dataProvider->query->orderBy('orders.id', 'asc');
        }

        return $dataProvider;
    }
}
