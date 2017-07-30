<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


$initYii2Middleware = function ($request, $next)
{
    define('YII_DEBUG', env('APP_DEBUG'));
    include '../vendor/yiisoft/yii2/Yii.php';
    spl_autoload_unregister(['Yii', 'autoload']);
    $config = [
        'id' => 'yii2-laravel',
        'basePath' => '../',
        'timezone' => 'UTC',
        'components' => [
            'db' => [
                'class' => \yii\db\Connection::class,
                'dsn' => 'mysql:host='.env('DB_HOST', 'localhost')
                    .';port='.env('DB_PORT', '3306')
                    .';dbname='.env('DB_DATABASE', 'forge'),
                'username' => env('DB_USERNAME', 'forge'),
                'password' => env('DB_PASSWORD', ''),
                'charset' => 'utf8',
            ],
            'assetManager' => [
                'basePath' => '@webroot/yii-assets',
                'baseUrl' => '@web/yii-assets',

                'bundles' => [
                    'yii\web\JqueryAsset' => [
                        'sourcePath' => null,
                        'basePath' => null,
                        'baseUrl' => null,
                        'js' => [],
                    ],
                ],
            ],
            'request' => [
                'class' => \App\Yii\Web\Request::class,
                'csrfParam' => '_token',
            ],
            'urlManager' => [
                'enablePrettyUrl' => true,
                'showScriptName' => false,
            ],
            'view' => [
                'class' => \App\Yii\Web\View::class,
            ],
            'formatter' => [
                'dateFormat' => 'php:m/d/Y',
                'datetimeFormat' => 'php:m/d/Y H:i:s',
                'timeFormat' => 'php:H:i:s',
                'defaultTimeZone' => 'UTC',
            ],
        ],
    ];
    if (YII_DEBUG) {
        $config['modules']['gii'] = ['class' => \yii\gii\Module::class];
        $config['bootstrap'][] = 'gii';
    }
    (new \yii\web\Application($config));  // initialization is in constructor
    Yii::setAlias('@bower', Yii::getAlias('@vendor') . DIRECTORY_SEPARATOR . 'bower-asset');
    Yii::setAlias('@App', Yii::getAlias('@app') . DIRECTORY_SEPARATOR . 'App');

    return $next($request);
};

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => $initYii2Middleware], function () {
    Route::get('/order', 'OrderController@index')->name('order.index');
    Route::get('/order/view/{id}', 'OrderController@view')->name('order.view');
    Route::get('/order/create', 'OrderController@create')->name('order.create');
    Route::get('/order/update/{id}', 'OrderController@update')->name('order.update');
    Route::post('/order/create', 'OrderController@create');
    Route::post('/order/update/{id}', 'OrderController@update');
    Route::post('/order/delete/{id}', 'OrderController@delete')->name('order.delete');

    Route::any('gii{params?}', function () {
        $request = \Yii::$app->getRequest();
        $request->setBaseUrl('/admin');
        \Yii::$app->run();
        return null;
    })->where('params', '(.*)');
});
