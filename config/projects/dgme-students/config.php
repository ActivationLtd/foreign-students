<?php
/**
 * Project specific config file.
 */
return [

    /*
    |--------------------------------------------------------------------------
    | Application Name
    |--------------------------------------------------------------------------
    |
    | This value is the name of your application. This value is used when the
    | framework needs to place the application's name in a notification or
    | any other location as required by the application or its packages.
    |
    */

    'name' => env('PROJECT', 'DgmeStudents'),

    /*
    |--------------------------------------------------------------------------
    | Default Email CCs
    |--------------------------------------------------------------------------
    |
    | Some of the emails will go out to a number of admin user.
    |
    */

    'default_email_recipients' => [
        'su@mainframe',
    ],

    /*
    |--------------------------------------------------------------------------
    | Section : Project specific custom config
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | List default email recipients
    |--------------------------------------------------------------------------
    |
    */
    # Developers
    'dev_emails' => [
        'devs@activationltd.com',
        'raihan.act@gmail.com',
        'sanjidhabib@gmail.com',
    ],
    # Live users
    'admin_update_emails' => [
        'dgme-admins@dgmebd.com'
    ],

];