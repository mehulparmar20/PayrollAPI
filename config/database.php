<?php

use Illuminate\Support\Str;

return [

    /*
    |--------------------------------------------------------------------------
    | Default Database Connection Name
    |--------------------------------------------------------------------------
    |
    | Here you may specify which of the database connections below you wish
    | to use as your default connection for all database work. Of course
    | you may use many connections at once using the Database library.
    |
    */

    'default' => env('DB_CONNECTION', 'mysql'),

    /*
    |--------------------------------------------------------------------------
    | Database Connections
    |--------------------------------------------------------------------------
    |
    | Here are each of the database connections setup for your application.
    | Of course, examples of configuring each database platform that is
    | supported by Laravel is shown below to make development simple.
    |
    |
    | All database work in Laravel is done through the PHP PDO facilities
    | so make sure you have the driver for your particular database of
    | choice installed on your machine before you begin development.
    |
    */

    
    'connections' => [

        'mongodb' => [
            'driver' => 'mongodb',
            // 'dsn' => env('DB_URI', 'mongodb://10.188.4.129:27017/WindsonDispatch?readPreference=primary&directConnection=true&ssl=false'), //server
            // 'dsn' => env('DB_URI', 'mongodb+srv://astraportal:astraportal@astra.7uwteaq.mongodb.net/'), //server
            'dsn' => env('DB_URI', 'mongodb+srv://astraportal:astraportal@astra.7uwteaq.mongodb.net/'), //server
            
            // 'dsn' => env('DB_URI', 'mongodb://appUser:appPassword@103.102.57.94:27017/WindsonDispatch?readPreference=primary&directConnection=true&ssl=false'), //dharmaj
            // 'dsn' => env('DB_URI', 'mongodb://astra:Astravo@203.88.144.78:27017/?authMechanism=SCRAM-SHA-1'),
            // 'dsn' => env('DB_URI', 'mongodb://172.31.89.128:27017'), //local
            // 'dsn' => env('DB_URI', 'mongodb://192.168.0.10:27017/WindsonDispatch?readPreference=primary&directConnection=true&ssl=false'), //dharmaj

            'database' => 'WindsonPayroll',

        ]

    ],

    /*
    |--------------------------------------------------------------------------
    | Migration Repository Table
    |--------------------------------------------------------------------------
    |
    | This table keeps track of all the migrations that have already run for
    | your application. Using this information, we can determine which of
    | the migrations on disk haven't actually been run in the database.
    |
    */

    'migrations' => 'migrations',

    /*
    |--------------------------------------------------------------------------
    | Redis Databases
    |--------------------------------------------------------------------------
    |
    | Redis is an open source, fast, and advanced key-value store that also
    | provides a richer body of commands than a typical key-value system
    | such as APC or Memcached. Laravel makes it easy to dig right in.
    |
    */

    'redis' => [

        'client' => env('REDIS_CLIENT', 'phpredis'),

        'options' => [
            'cluster' => env('REDIS_CLUSTER', 'redis'),
            'prefix' => env('REDIS_PREFIX', Str::slug(env('APP_NAME', 'laravel'), '_').'_database_'),
        ],

        'default' => [
            'url' => env('REDIS_URL'),
            'host' => env('REDIS_HOST', '127.0.0.1'),
            'username' => env('REDIS_USERNAME'),
            'password' => env('REDIS_PASSWORD'),
            'port' => env('REDIS_PORT', '6379'),
            'database' => env('REDIS_DB', '0'),
        ],

        'cache' => [
            'url' => env('REDIS_URL'),
            'host' => env('REDIS_HOST', '127.0.0.1'),
            'username' => env('REDIS_USERNAME'),
            'password' => env('REDIS_PASSWORD'),
            'port' => env('REDIS_PORT', '6379'),
            'database' => env('REDIS_CACHE_DB', '1'),
        ],

    ],

];
