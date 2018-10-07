<?php

/*
 * The default file system disk used is 'Public'.
 * Any path unless specified is relative to 'storage/app/public'.
 */

return [

    /*
    |--------------------------------------------------------------------------
    | Default file upload configurations
    |--------------------------------------------------------------------------
    */

    'uploads' => [
        'image' => [
            'encode' => 'jpg',
            'allowed_mime' => ['jpeg', 'png', 'bmp'],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | User specific configurations
    |--------------------------------------------------------------------------
    */

    'user' => [
        'upload' => [
            'profile-picture' => [
                'path' => 'uploads/user/profile-picture/',
                'image' => [
                    'min_resolution' => 100,
                    'store_resolution' => 150,
                    'max_file_size_kb' => 1000,
                ],
            ],
            'ticket' => [
                'path' => 'uploads/user/ticket/',
                'image' => [
                    'max_file_size_kb' => 2000,
                ],
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Packers and Movers specific configurations
    |--------------------------------------------------------------------------
    */

    'shop' => [

        'appointment' => [
            'schedule_start_time' => '09:00:00',
            'schedule_end_time' => '18:00:00',
            'cutoff_time' => '14:00:00',
        ],

        'upload' => [
            'logo' => [
                'path' => 'uploads/shop/',
                'image' => [
                    'min_resolution' => 150,
                    'store_resolution' => 200,
                    'max_file_size_kb' => 2000,
                ],
            ],
            'gallery' => [
                'path' => 'uploads/shop/',
                'image' => [
                    'min_resolution' => 200,
                    'store_resolution' => 1280,
                    'thumb_resolution' => 150,
                    'max_file_size_kb' => 5000,
                ],
            ],
        ],

        /*
         * These files use the local disk. The files are not publicly accessible.
         * The paths are relative to 'storage/app'.
         * They can be used in emails and downloaded/streamed using controller response.
         */
        'files' => [
            'invoice' => [
                'user' => 'files/shop/invoice/user/',
                'vendor' => 'files/shop/invoice/vendor/',
            ],
            'quotation' => 'files/shop/quotation/',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Corporate specific configurations
    |--------------------------------------------------------------------------
    */

    'corporate' => [

        'upload' => [
            'file' => [
                'path' => 'uploads/corporate/file',
                'max_file_size_kb' => 5000,
                'max_file_uploads' => 5,
                'allowed_mime' => ['jpeg', 'png', 'bmp', 'pdf', 'csv', 'xls', 'xlsx'],
            ],
            'employee' => [
                'max_file_size_kb' => 5000,
                'allowed_mimetypes' => [
                    'application/vnd.ms-excel', // Excel 2003
                    'application/vnd.ms-office', // Open office
                    'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', // Excel 2007+
                ],
            ],
            'logo' => [
                'path' => 'uploads/corporate/logo',
                'image' => [
                    'min_resolution' => 150,
                    'store_resolution' => 200,
                    'max_file_size_kb' => 2000,
                ],
            ],
        ],

        /*
         * These files use the local disk. The files are not publicly accessible.
         * The paths are relative to 'storage/app'.
         * They can be used in emails and downloaded/streamed using controller response.
         */
        'files' => [
            'invoice' => 'files/corporate/invoice',
            'customer' => 'files/corporate/customer',
        ],

        /*
         * Approval lifespan from Approvable instance date.
         */
        'approval_lifespan' => 30,

        /*
         * Approval Resend delay in minutes.
         */
        'approval_resend_delay' => 300,

    ],

    /*
    |--------------------------------------------------------------------------
    | Default common configurations
    |--------------------------------------------------------------------------
    */

    'default' => [
        /*
         * The paths are relative to the public folder 'public'.
         */
        'user' => [
            'profile_picture' => 'default-user-image.png',
        ],

        'shop' => [
            'logo' => '/static/images/default-shop-logo.jpg',
        ],
    ],

    'pdf' => [
        'generator' => 'dompdf.wrapper',
    ],

    /*
    |--------------------------------------------------------------------------
    | Web/App configurations
    |--------------------------------------------------------------------------
    */

    'web' => [
        'business' => [
            'gstin'       => env('GST_IN', 'GST'),
            'gstin_state' => env('GST_IN_STATE', 'Kerala'),
        ],

        'verification' => [
            'google' => env('GOOGLE_VERIFICATION_KEY'),
            'bing'   => env('BING_VERIFICATION_KEY'),
        ],

        'links' => [
            'facebook'    => env('FACEBOOK_LINK'),
            'twitter'     => env('TWITTER_LINK'),
            'instagram'   => env('INSTAGRAM_LINK'),
            'google_plus' => env('GOOGLEPLUS_LINK'),
        ],
    ],

];
