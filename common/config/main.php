<?php
return [
    'name' => 'bantinthethao.com',
    'charset' => 'UTF-8',
    'language' => 'vi-VN',
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'db' => [
            // database config
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=spacev_vn',
            'username' => 'thethao_u',
            'password' => 'd8$#$0+=8bPfDdf#$FD',

            'charset' => 'utf8',
            'enableSchemaCache' => false,
            // Duration of schema cache.
            'schemaCacheDuration' => 3600,
            // Name of the cache component used to store schema information
            'schemaCache' => 'cache',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
            'useFileTransport' => false,
            'transport' => [
                'class' => 'Swift_SmtpTransport',
//                'host' => 'smtp.gmail.com',
//                'username' => 'info.quyettran@gmail.com',
//                'password' => 'eyyjdwlsktrjiaqq',
//                'port' => 465,
//                'encryption' => 'ssl',
                'host' => 'mail.veneto.vn',
                'username' => 'noreply@veneto.vn',
                'password' => 'KHJ889@!5njPQR',
                'port' => 465,
                'encryption' => 'ssl',
            ], 
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
            'cachePath' => '@common/runtime/cache',
        ],
    ],
    'modules' => [
        'admin' => [
            'class' => 'mdm\admin\Module',
            'controllerMap' => [
                'assignment' => [
                    'class' => 'mdm\admin\controllers\AssignmentController',
                    'userClassName' => 'common\models\User',
                    'idField' => 'id', // id field of model User
                ]
            ],
        ]
    ],    
];
