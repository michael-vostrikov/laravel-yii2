<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::query();

        $gridViewConfig = [
            'dataProvider' => new \App\Yii\Data\EloquentDataProvider([
                'query' => $query,
                'pagination' => ['route' => $request->route()->uri(), 'defaultPageSize' => 10],
                'sort' => ['route' => $request->route()->uri(), 'attributes' => ['id']],
            ]),
            'columns' => [
                'id',
                'user.name',
                ['label' => 'Items', 'format' => 'raw', 'value' => function ($model) {
                    $html = '';
                    foreach ($model->items as $item) {
                        $html .= '<div>' . htmlspecialchars($item->product->name) . '</div>';
                    }
                    return $html;
                }],
                'created_at:datetime',
                'updated_at:datetime',

                [
                    'class' => \yii\grid\ActionColumn::class,
                    'urlCreator' => function ($action, $model, $key) use ($request) {
                        $baseRoute = $request->route()->getName();

                        $baseRouteParts = explode('.', $baseRoute);
                        $baseRouteParts[count($baseRouteParts) - 1] = $action;
                        $route = implode('.', $baseRouteParts);

                        $params = is_array($key) ? $key : ['id' => (string) $key];

                        return route($route, $params, false);
                    }
                ],
            ],
        ];

        return view('admin.order.index', ['gridViewConfig' => $gridViewConfig]);
    }

    public function view()
    {
    }

    public function create()
    {
    }

    public function update()
    {
    }

    public function delete()
    {
    }
}
