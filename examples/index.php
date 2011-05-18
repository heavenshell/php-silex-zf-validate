<?php
require_once 'silex.phar';
require_once dirname(__DIR__) . '/src/Zf1/ValidateExtension.php';

$zendpath = getenv('ZF_PATH');

$app = new Silex\Application();
$app->register(new \Zf1\ValidateExtension(), array(
    'zend.class_path' => $zendpath,
));

$app->get('/',  function () use ($app) {});

$app->get('/success', function () use ($app) {
    $validator = $app['zend.validate']('alnum');
    $result    = $validator->isvalid('abcd');

    return $result;
});

$app->get('/alnum', function () use ($app) {
    $validator = $app['zend.validate']('alnum');
    $result    = $validator->isvalid('abcd12+-');
    $messages  = $validator->getMessages();

    return $messages['notAlnum'];
});

$app->get('/alpha', function () use ($app) {
    $validator = $app['zend.validate']('alpha');
    $result    = $validator->isvalid('abcd12');
    $messages  = $validator->getMessages();

    return $messages['notAlpha'];
});

$app->get('/barcode', function () use ($app) {
    $validator = $app['zend.validate']('barcode', 'EAN13');
    $result    = $validator->isvalid('12345');
    $messages  = $validator->getMessages();

    return $messages['barcodeInvalidLength'];
});

$app->get('/between', function () use ($app) {
    $validator = $app['zend.validate']('between',
        array('min' => 0, 'max' => 5)
    );
    $result    = $validator->isvalid('123456');
    $messages  = $validator->getMessages();

    return $messages['notBetween'];
});

$app->run();
