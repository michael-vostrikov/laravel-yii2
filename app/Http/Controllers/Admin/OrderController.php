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

                ['class' => \App\Yii\Widgets\ActionColumn::class],
            ],
        ];

        return view('admin.order.index', ['gridViewConfig' => $gridViewConfig]);
    }

    public function view($id)
    {
        $model = Order::findOrFail($id);
        $formModel = new \App\Forms\Admin\OrderForm($model);

        $detailViewConfig = [
            'model' => $formModel,
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
                'id:text:ID',
                'product.name:text:Product',
                'created_at:datetime:Created At',
                'updated_at:datetime:Updated At',
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

        $form = new \App\Yii\Widgets\FormBuilder($formModel);

        return view('admin.order.create', ['form' => $form]);
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

        $form = new \App\Yii\Widgets\FormBuilder($formModel);

        return view('admin.order.update', ['form' => $form]);
    }

    public function delete($id)
    {
        $model = Order::findOrFail($id);
        $model->delete();

        return redirect()->route('admin.order.index');
    }
}
