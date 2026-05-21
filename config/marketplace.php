<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Marketplace identity (defaults; overridden by storage when saved in admin)
    |--------------------------------------------------------------------------
    */

    'name' => env('MARKETPLACE_NAME', 'Sahara Autolink'),

    'support_email' => env('MARKETPLACE_SUPPORT_EMAIL', 'info@saharaautolink.co.tz'),

    'tagline' => env('MARKETPLACE_TAGLINE', env('SAHARA_BRAND_TAGLINE', 'Driven by Trust, Powered by Excellence')),

];
