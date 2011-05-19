<?php
require_once 'silex.phar';
require_once dirname(__DIR__) . '/src/Zf1/ValidateExtension.php';

$zendpath = getenv('ZF_PATH');

$app = new Silex\Application();
$app->register(new \Zf1\ValidateExtension(), array(
    'zend.class_path' => $zendpath,
));

$app->get('/', function () use ($app) {});

$app->get('/success', function () use ($app) {
    $validator = $app['zend.validate']('alnum');
    $result    = $validator->isValid('abcd');

    return $result;
});

$app->get('/alnum', function () use ($app) {
    $validator = $app['zend.validate']('alnum');
    $result    = $validator->isValid('abcd12+-');
    $messages  = $validator->getMessages();

    return $messages[key($messages)];
});

$app->get('/alpha', function () use ($app) {
    $validator = $app['zend.validate']('alpha');
    $result    = $validator->isValid('abcd12');
    $messages  = $validator->getMessages();
    $key       = key($messages);

    return $messages[key($messages)];
});

$app->get('/barcode', function () use ($app) {
    $validator = $app['zend.validate']('barcode', 'EAN13');
    $result    = $validator->isValid('12345');
    $messages  = $validator->getMessages();

    return $messages[key($messages)];
});

$app->get('/between', function () use ($app) {
    $validator = $app['zend.validate']('between',
        array('min' => 0, 'max' => 5)
    );
    $result    = $validator->isValid('123456');
    $messages  = $validator->getMessages();

    return $messages[key($messages)];
});

$app->run();
