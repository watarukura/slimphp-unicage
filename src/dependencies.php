<?php
// DIC configuration
$container = $app->getContainer();

if ($container->get('settings')['debug']) {
    // ob_start前のエラーをハンドルする
    $whoops = new Whoops\Run;
    $whoops->pushHandler(new Whoops\Handler\PrettyPageHandler);
    $whoops->register();
    // ob_start以降のエラーをハンドルする
    /**
     * @param $c
     * @return \Dopesong\Slim\Error\Whoops
     */
    $container['phpErrorHandler'] = function ($c) {
        return new Dopesong\Slim\Error\Whoops($c->get('settings')['displayErrorDetails']);
    };

    // debugbar setting
    $settings = $container->get('settings')['debugbar'];
    $provider = new Kitchenu\Debugbar\ServiceProvider($settings);
    $provider->register($app);
}

// view renderer
$container['renderer'] = function ($c) {
    $settings = $c->get('settings')['renderer'];
    return new Slim\Views\PhpRenderer($settings['template_path']);
};

// monolog
$container['logger'] = function ($c) {
    $settings = $c->get('settings')['logger'];
    $logger = new Monolog\Logger($settings['name']);
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['path'], $settings['level']));
    return $logger;
};
