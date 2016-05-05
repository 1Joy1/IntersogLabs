<?php
use yii\web\Response;

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => [
        [
            'class' => 'yii\filters\ContentNegotiator',
            'formats' => [
                'application/json' => Response::FORMAT_JSON,
                'application/xml' => Response::FORMAT_XML,
            ],
        ],
        'log',
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'Leg0jIZ_ZuaGxVVr1AQGEkqYTjYgR_VU',
            'parsers'=> [
                'application/json' =>'yii\web\JsonParser'],
        ],        
        'cache' => [
            //'class' => 'yii\caching\FileCache',
            'class' => 'yii\caching\MemCache',
            'servers' => [
                [
                    'host' => '127.0.0.1',
                    'port' => 11211,
                    //'weight' => 600,
                ],
            ],
        ],        
        'user' => [
            'identityClass' => 'app\models\Users',
            'enableAutoLogin' => true,
            'enableSession' => false,   //для не сохранении информац о клиенте
        ],
        /*'errorHandler' => [
            'errorAction' => 'site/error',
        ],*/
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'transport' => ['class' => 'Swift_SmtpTransport',
                            'host' =>  'smtp.gmail.com',
                            'username' => 'intersog.labs@gmail.com',
                            'password' => 'BynthcjuKf,c',
                            'port' => '465',
                            'encryption' => 'ssl',
                           ],
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => false,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => require(__DIR__ . '/db.php'),
        
        'urlManager' => [
            'enablePrettyUrl' => true,
            'enableStrictParsing' => true,
            'showScriptName' => false,
            'rules' => [
                ['class' => 'yii\rest\UrlRule', 'controller' => 'users'],
                ['class' => 'yii\rest\UrlRule', 'controller' => 'albums', 'extraPatterns' => [
                    'GET <id:\d+>/images' => 'index-images',
                    'POST <id:\d+>/images' => 'create-images',
                    'PUT <id:\d+>/images' => 'not-allowed', 
                    'DELETE <id:\d+>/images' => 'not-allowed',
                    'GET <id:\d+>/images/<image_id:\d+>' => 'view-images',
                    'POST <id:\d+>/images/<image_id:\d+>' => 'not-allowed',
                    'PUT <id:\d+>/images/<image_id:\d+>' => 'update-images',
                    'DELETE <id:\d+>/images/<image_id:\d+>' => 'delete-images',
                    ],
                ],
                ['class' => 'yii\rest\UrlRule', 'controller' => 'auth', 'extraPatterns' => [
                    'POST logout' => 'logout',                    
                    'POST reset' => 'reset-pass',
                    'PUT reset' => 'change-pass',
                    'HEAD reset' => 'check-code',
                    'GET reset' => 'not-allowed',
                   ], 'pluralize' => false, 'except' => ['index', 'create', 'options'], 
                ],
                //['class' => 'yii\rest\UrlRule', 'controller' => 'album-images'],
            ],
        ],
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;
