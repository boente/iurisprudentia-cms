<?php

return [

    'default' => 'custom_json',

    'drivers' => [
        'md' => \Orbit\Drivers\Markdown::class,
        'json' => \Orbit\Drivers\Json::class,
        'yaml' => \Orbit\Drivers\Yaml::class,
        'custom_json' => \App\Drivers\CustomJson::class,
    ],

    'paths' => [
        'content' => env('IURISPRUDENTIA_PATH').'/frontend/public',
        'cache' => storage_path('framework/cache/orbit'),
    ],

];
