<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $filterModel = new \App\Forms\Admin\OrderFilter();

        $dataProvider = $filterModel->applyFilter($request);

        $gridViewConfig = [
            'dataProvider' => $dataProvider,
            'filterModel' => $filterModel,
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

    public function view($id)
    {
        $model = Order::findOrFail($id);

        $detailViewConfig = [
            'model' => $model,
            'attributes' => [
                'id',
                'user.name',
                'created_at:datetime',
                'updated_at:datetime',
            ],
        ];

        $gridViewConfig = [
            'dataProvider' => new \App\Yii\Data\EloquentDataProvider([
                'query' => $model->items(),
                'pagination' => false,
                'sort' => false,
            ]),
            'layout' => '{items}{summary}',
            'columns' => [
                'id',
                'product.name',
                'created_at:datetime',
                'updated_at:datetime',
            ],
        ];

        return view('admin.order.view', ['model' => $model, 'detailViewConfig' => $detailViewConfig, 'gridViewConfig' => $gridViewConfig]);
    }

    public function create(Request $request)
    {
        $model = new Order();
        $formModel = new \App\Forms\Admin\OrderForm($model);

        if ($request->isMethod('post')) {
            if ($formModel->load($request->input()) && $formModel->save()) {
                return redirect()->route('admin.order.view', ['id' => $model->id]);
            }
        }

        return view('admin.order.create', ['formModel' => $formModel]);
    }

    public function update($id, Request $request)
    {
        $model = Order::findOrFail($id);
        $formModel = new \App\Forms\Admin\OrderForm($model);

        if ($request->isMethod('post')) {
            if ($formModel->load($request->input()) && $formModel->save()) {
                return redirect()->route('admin.order.view', ['id' => $model->id]);
            }
        }

        return view('admin.order.update', ['formModel' => $formModel]);
    }

    public function delete()
    {
    }
}
