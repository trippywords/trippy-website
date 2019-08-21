<?php

return [

    /*
     * The API key of a MailChimp account. You can find yours at
     * https://us10.admin.mailchimp.com/account/api-key-popup/.
     */
//    'apiKey' =>'38fef3101a9a135cf0da066bc0570297-us18',
    'apiKey' =>'acef10a3b9b535bfa7d8b79d6cd6c78d-us17',

    /*
     * The listName to use when no listName has been specified in a method.
     */
    'defaultListName' => 'subscribers',
    /*
     * Here you can define properties of the lists.
     */
    'lists' => [

        /*
         * This key is used to identify this list. It can be used
         * as the listName parameter provided in the various methods.
         *
         * You can set it to any string you want and you can add
         * as many lists as you want.
        */
        'subscribers' => [

            /*
             * A MailChimp list id. Check the MailChimp docs if you don't know
             * how to get this value:
             * http://kb.mailchimp.com/lists/managing-subscribers/find-your-list-id.
             */
//          'id' => 'a888eff8bb',
            'id' => 'd34721027b'
        ],
    ],

    /*
     * If you're having trouble with https connections, set this to false.
     */
    'ssl' => true,

];
