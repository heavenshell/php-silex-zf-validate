<?php
require_once 'silex.phar';
require_once dirname(__DIR__) . '/src/Zf1/ValidateExtension.php';

$zendpath = getenv('ZF_PATH');
$resouce  = __DIR__ . '/resouces/Zend_Validate.php';

$app = new Silex\Application();
$app->register(new \Zend\ValidateExtension(), array(
    'locale'            => 'ja',
    'zend.class_path'   => $zendpath,
    'zend.resouce_path' => $resouce,
));

$app->get('/alnum', function () use ($app) {
    $validator = $app['zend.validate']('alnum');
    $result    = $validator->isvalid('abcd12+-');
    $messages  = $validator->getMessages();

    return $messages['notAlnum'];

});

$app->run();
