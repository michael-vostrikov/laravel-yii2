<?php

namespace App\Yii\Data;

/**
 * EloquentDataProvider provides Eloquent models for \yii\data\GridView
 */
class EloquentDataProvider extends \yii\data\BaseDataProvider
{
    /**
     * @var \Illuminate\Database\Eloquent\Builder
     */
    public $query;

    /**
     * @var string
     * @see getKeys()
     */
    public $key;


    /**
     * @inheritdoc
     */
    protected function prepareModels()
    {
        $query = clone $this->query;

        if (($pagination = $this->getPagination()) !== false) {
            $pagination->totalCount = $this->getTotalCount();
            if ($pagination->totalCount === 0) {
                return [];
            }
            $query->limit($pagination->getLimit())->offset($pagination->getOffset());
        }

        if (($sort = $this->getSort()) !== false) {
            $this->addOrderBy($query, $sort->getOrders());
        }

        return $query->get()->all();
    }

    /**
     * @inheritdoc
     */
    protected function prepareKeys($models)
    {
        $keys = [];
        if ($this->key !== null) {
            foreach ($models as $model) {
                $keys[] = $model[$this->key];
            }

            return $keys;
        } else {
            $pks = $this->query->getModel()->getKeyName();

            if (is_string($pks)) {
                $pk = $pks;
                foreach ($models as $model) {
                    $keys[] = $model[$pk];
                }
            } else {
                foreach ($models as $model) {
                    $kk = [];
                    foreach ($pks as $pk) {
                        $kk[$pk] = $model[$pk];
                    }
                    $keys[] = $kk;
                }
            }

            return $keys;
        }
    }

    /**
     * @inheritdoc
     */
    protected function prepareTotalCount()
    {
        $query = clone $this->query;
        $query->orders = null;
        $query->offset = null;

        return (int) $query->limit(-1)->count('*');
    }

    /**
     * Add ORDER BY to query by sort orders
     */
    protected function addOrderBy($query, $orders)
    {
        foreach ($orders as $attribute => $order) {
            if ($order === SORT_ASC) {
                $query->orderBy($attribute, 'asc');
            } else {
                $query->orderBy($attribute, 'desc');
            }
        }
    }
}
