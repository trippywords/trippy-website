<?php



return [



    /*

    |--------------------------------------------------------------------------

    | Third Party Services

    |--------------------------------------------------------------------------

    |

    | This file is for storing the credentials for third party services such

    | as Stripe, Mailgun, SparkPost and others. This file provides a sane

    | default location for this type of information, allowing packages

    | to have a conventional place to find your various credentials.

    |

    */



    'mailgun' => [

        'domain' => env('MAILGUN_DOMAIN'),

        'secret' => env('MAILGUN_SECRET'),

    ],



    'ses' => [

        'key' => env('SES_KEY'),

        'secret' => env('SES_SECRET'),

        'region' => 'us-east-1',

    ],



    'sparkpost' => [

        'secret' => env('SPARKPOST_SECRET'),

    ],



    'stripe' => [

        'model' => App\User::class,

        'key' => env('STRIPE_KEY'),

        'secret' => env('STRIPE_SECRET'),

    ],

//   'facebook' => [

//    'client_id' => '188114465345493',         // Your GitHub Client ID env('GITHUB_CLIENT_ID')

//    'client_secret' => 'c7222e0a2bdad01ba15eb299cc66711b', // Your GitHub Client Secret env('GITHUB_CLIENT_SECRET')

//    'redirect' => 'https://trippywords-web.cosmonautgroup.com/public',

//    ],

//    'twitter' => [

//    'client_id' => 'YcQzVp5OOlgmkmJOGhyptb1uK',         // Your GitHub Client ID env('GITHUB_CLIENT_ID')

//    'client_secret' => 'aOhZhrBA6oQRzwKpvAHbKGZEcDyLPpfRdAZCTutazCPzd0byd3', // Your GitHub Client Secret env('GITHUB_CLIENT_SECRET')

//    'redirect' => 'http://trippywords-web.cosmonautgroup.com/public',

//    ],

   'facebook' => [
    'client_id' => '2164258997149726',
    'client_secret' => 'e892c253ec575446c1314d41db4bb35d',
    'redirect' => 'https://www.trippywords.com/auth/facebook/callback/',
    ],
    
    'twitter' => [
    'client_id' => 'JNJ2vCFqPq7TwiQfDvlrJ3jWF',
    'client_secret' => '4Z5OWAUaOlDTqhkII5YdoQjwQPCuAkgkG2gWTDf5XWeMRCw3Xw',
    'redirect' => 'http://www.trippywords.com/twittercallback/',
    ],
];

