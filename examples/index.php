<?php
require_once 'silex.phar';
require_once dirname(__DIR__) . '/src/Zf1/ValidateExtension.php';

$zendpath = getenv('ZF_PATH');

$app = new Silex\Application();
$app->register(new \Zf1\ValidateExtension(), array(
    'zend.class_path' => $zendpath,
));

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

$app->get('/callback', function () use ($app) {
    $validator = $app['zend.validate']('callback', function($value) {
        return false;
    });
    $result    = $validator->isValid('value');
    $messages  = $validator->getMessages();

    return $messages[key($messages)];
});

$app->get('/creditcard', function () use ($app) {
    $validator = $app['zend.validate'](
        'CreditCard', \Zend_Validate_CreditCard::VISA
    );
    $result    = $validator->isValid('value');
    $messages  = $validator->getMessages();

    return $messages[key($messages)];
});

$app->get('/date', function () use ($app) {
    $validator = $app['zend.validate']('date');
    $result    = $validator->isValid('value');
    $messages  = $validator->getMessages();

    return $messages[key($messages)];
});

$app->get('/digits', function () use ($app) {
    $validator = $app['zend.validate']('digits');
    $result    = $validator->isValid('value');
    $messages  = $validator->getMessages();

    return $messages[key($messages)];
});

$app->get('/emailaddress', function () use ($app) {
    $validator = $app['zend.validate']('EmailAddress');
    $result    = $validator->isValid('example@example');
    $messages  = $validator->getMessages();

    return $messages[key($messages)];
});

$app->get('/float', function () use ($app) {
    $validator = $app['zend.validate']('float');
    $result    = $validator->isValid('value');
    $messages  = $validator->getMessages();

    return $messages[key($messages)];
});

$app->get('/greaterthan', function () use ($app) {
    $validator = $app['zend.validate']('GreaterThan', array('min' => 2));
    $result    = $validator->isValid(1);
    $messages  = $validator->getMessages();

    return $messages[key($messages)];
});

$app->get('/hex', function () use ($app) {
    $validator = $app['zend.validate']('hex');
    $result    = $validator->isValid('value');
    $messages  = $validator->getMessages();

    return $messages[key($messages)];
});

$app->get('/hostname', function () use ($app) {
    $validator = $app['zend.validate']('hostname');
    $result    = $validator->isValid('value');
    $messages  = $validator->getMessages();

    return $messages[key($messages)];
});

$app->get('/iban', function () use ($app) {
    $validator = $app['zend.validate']('iban');
    $result    = $validator->isValid('AT');
    $messages  = $validator->getMessages();

    return $messages[key($messages)];
});

$app->get('/identical', function () use ($app) {
    $validator = $app['zend.validate']('identical', 'origin');
    $result    = $validator->isValid('value');
    $messages  = $validator->getMessages();

    return $messages[key($messages)];
});

$app->get('/inarray', function () use ($app) {
    $validator = $app['zend.validate']('InArray', array('key' => 'value'));
    $result    = $validator->isValid('val');
    $messages  = $validator->getMessages();

    return $messages[key($messages)];
});

$app->get('/int', function () use ($app) {
    $validator = $app['zend.validate']('int');
    $result    = $validator->isValid('val');
    $messages  = $validator->getMessages();

    return $messages[key($messages)];
});

$app->get('/ip', function () use ($app) {
    $validator = $app['zend.validate']('ip');
    $result    = $validator->isValid('localhost');
    $messages  = $validator->getMessages();

    return $messages[key($messages)];
});

$app->get('/isbn', function () use ($app) {
    $validator = $app['zend.validate']('isbn',
        array('type' => Zend_Validate_Isbn::ISBN13)
    );
    $result    = $validator->isValid('value');
    $messages  = $validator->getMessages();

    return $messages[key($messages)];
});

$app->get('/lessthan', function () use ($app) {
    $validator = $app['zend.validate']('LessThan', array('max' => '1'));
    $result    = $validator->isValid(12);
    $messages  = $validator->getMessages();

    return $messages[key($messages)];
});

$app->get('/notempty', function () use ($app) {
    $validator = $app['zend.validate']('NotEmpty',
        \Zend_Validate_NotEmpty::INTEGER
    );
    $result    = $validator->isValid(0);
    $messages  = $validator->getMessages();

    return $messages[key($messages)];
});

$app->get('/postcode', function () use ($app) {
    $validator = $app['zend.validate']('PostCode', 'jp');
    $result    = $validator->isValid(0);
    $messages  = $validator->getMessages();

    return $messages[key($messages)];
});

$app->get('/regex', function () use ($app) {
    $validator = $app['zend.validate']('Regex', array('pattern' => '/^test/'));
    $result    = $validator->isValid('value');
    $messages  = $validator->getMessages();

    return $messages[key($messages)];
});

$app->get('/sitemap-changefreq', function () use ($app) {
    $validator = $app['zend.validate']('Sitemap_Changefreq');
    $result    = $validator->isValid('yesterday');
    $messages  = $validator->getMessages();

    return $messages[key($messages)];
});

$app->get('/sitemap-lastmod', function () use ($app) {
    $validator = $app['zend.validate']('Sitemap_Lastmod');
    $result    = $validator->isValid('yesterday');
    $messages  = $validator->getMessages();

    return $messages[key($messages)];
});

$app->get('/sitemap-loc', function () use ($app) {
    $validator = $app['zend.validate']('Sitemap_Loc');
    $result    = $validator->isValid('localhost');
    $messages  = $validator->getMessages();

    return $messages[key($messages)];
});

$app->get('/sitemap-priority', function () use ($app) {
    $validator = $app['zend.validate']('Sitemap_Priority');
    $result    = $validator->isValid('localhost');
    $messages  = $validator->getMessages();

    return $messages[key($messages)];
});

$app->get('/stringlength-priority', function () use ($app) {
    $validator = $app['zend.validate']('StringLength', array('max' => 1));
    $result    = $validator->isValid('ab');
    $messages  = $validator->getMessages();

    return $messages[key($messages)];
});




if (getenv('SILEX_TEST')) {
    return $app;
}
$app->run();
