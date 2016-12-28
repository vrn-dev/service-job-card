<?php

return [

    'driver' => env('MAIL_DRIVER', 'smtp'),

    'host' => env('MAIL_HOST', 'mailtrap.io'),

    'port' => env('MAIL_PORT', 25),

    'from' => [
        'address' => 'noreply@vrn.dev',
        'name' => 'VRN.dev',
    ],

    'encryption' => env('MAIL_ENCRYPTION', 'tls'),

    'username' => env('MAIL_USERNAME', '692b2d128cfe60'),

    'password' => env('MAIL_PASSWORD', '10d9ec4dc0dbdc'),

    'sendmail' => '/usr/sbin/sendmail -bs',

];
