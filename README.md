## Jade Gii Generator for Yii2

[![Latest Stable Version](https://packagist.org/packages/jacmoe/yii2-gii-jade)](https://packagist.org/packages/jacmoe/yii2-gii-jade)


Works well with [Yii2 Tale Jade](https://bitbucket.org/jacmoe/yii2-tale-jade), the Tale Jade for PHP integration for the Yii2 framework.

## Installation with Composer

Installation is recommended to be done via [composer](https://getcomposer.org) by running:
```bash
composer require jacmoe/yii2-gii-jade "*"
```

## Configuration
Add it to your configuration (frontend/config/main-local.php and/or backend/config/main-local.php for the advanced template).

~~~php
if (!YII_ENV_TEST) {
  // configuration adjustments for 'dev' environment
  $config['bootstrap'][] = 'debug';
  $config['modules']['debug'] = 'yii\debug\Module';

  $config['bootstrap'][] = 'gii';
  $config['modules']['gii'] = [
    'class' => 'yii\gii\Module',
    'allowedIPs' => ['127.0.0.1', '::1', '192.168.0.*', '192.168.178.20'],
    'generators' => [
      'jadecrud' => [
        'class' => 'jacmoe\giijade\crud\Generator',
        'templates' => [
          'myCrud' => '@jacmoe/giijade/crud/default',
        ]
      ]
    ],
  ];
}
~~~

## License
The Jade Gii Generator for Yii2 is released under the MIT license.