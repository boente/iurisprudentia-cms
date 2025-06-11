<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default filesystem disk that should be used
    | by the framework. The "local" disk, as well as a variety of cloud
    | based disks are available to your application for file storage.
    |
    */

    'default' => env('FILESYSTEM_DISK', 'local'),

    /*
    |--------------------------------------------------------------------------
    | Filesystem Disks
    |--------------------------------------------------------------------------
    |
    | Below you may configure as many filesystem disks as necessary, and you
    | may even configure multiple disks for the same driver. Examples for
    | most supported storage drivers are configured here for reference.
    |
    | Supported drivers: "local", "ftp", "sftp", "s3"
    |
    */

    'disks' => [

        'local' => [
            'driver' => 'local',
            'root' => storage_path('app/private'),
            'serve' => true,
            'throw' => false,
            'report' => false,
        ],

        'public' => [
            'driver' => 'local',
            'root' => storage_path('app/public'),
            'url' => env('APP_URL').'/storage',
            'visibility' => 'public',
            'throw' => false,
            'report' => false,
        ],

        's3' => [
            'driver' => 's3',
            'key' => env('AWS_ACCESS_KEY_ID'),
            'secret' => env('AWS_SECRET_ACCESS_KEY'),
            'region' => env('AWS_DEFAULT_REGION'),
            'bucket' => env('AWS_BUCKET'),
            'url' => env('AWS_URL'),
            'endpoint' => env('AWS_ENDPOINT'),
            'use_path_style_endpoint' => env('AWS_USE_PATH_STYLE_ENDPOINT', false),
            'throw' => false,
            'report' => false,
        ],

        'assets_backgrounds' => [
            'driver' => 'local',
            'root' => env('IURISPRUDENTIA_PATH').'/frontend/src/assets/backgrounds',
            'url' => env('APP_URL').'/relay/backgrounds',
            'visibility' => 'public',
            'throw' => false,
            'report' => false,
        ],
        'assets_logos' => [
            'driver' => 'local',
            'root' => env('IURISPRUDENTIA_PATH').'/frontend/src/assets/logos',
            'url' => env('APP_URL').'/relay/logos',
            'visibility' => 'public',
            'throw' => false,
            'report' => false,
        ],
        'assets_portraits' => [
            'driver' => 'local',
            'root' => env('IURISPRUDENTIA_PATH').'/frontend/src/assets/portraits',
            'url' => env('APP_URL').'/relay/portraits',
            'visibility' => 'public',
            'throw' => false,
            'report' => false,
        ],
        'assets_thumbnails' => [
            'driver' => 'local',
            'root' => env('IURISPRUDENTIA_PATH').'/frontend/src/assets/thumbnails',
            'url' => env('APP_URL').'/relay/thumbnails',
            'visibility' => 'public',
            'throw' => false,
            'report' => false,
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Symbolic Links
    |--------------------------------------------------------------------------
    |
    | Here you may configure the symbolic links that will be created when the
    | `storage:link` Artisan command is executed. The array keys should be
    | the locations of the links and the values should be their targets.
    |
    */

    'links' => [
        public_path('storage') => storage_path('app/public'),
    ],

];
