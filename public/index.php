<?php

require __DIR__ . '/../vendor/autoload.php';

// 实例化容器
$app = new \Illuminate\Container\Container;

// 注册事件服务提供者
(new \Illuminate\Events\EventServiceProvider($app))->register();

// 注册路由服务提供者
(new \Illuminate\Routing\RoutingServiceProvider($app))->register();


// 启动Eloquent ORM模块并进行相关配置
$manager = new \Illuminate\Database\Capsule\Manager();
$manager->addConnection(require '../config/database.php'); // 增加连接
$manager->bootEloquent();

// 加载路由
require __DIR__ . '/../app/Http/routes.php';

// 实例化请求
$request = \Illuminate\Http\Request::createFromGlobals();
// 分发处理请求
$response = $app['router']->dispatch($request);
// 返回请求响应
$response->send();