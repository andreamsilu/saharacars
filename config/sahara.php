<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Public WhatsApp (E.164 without +, digits only)
    |--------------------------------------------------------------------------
    */
    'whatsapp_phone' => env('SAHARA_WHATSAPP_PHONE', '255000000000'),

    /*
    |--------------------------------------------------------------------------
    | Public support email (report listing, inquiries)
    |--------------------------------------------------------------------------
    */
    'support_email' => env('SAHARA_SUPPORT_EMAIL', 'concierge@saharacars.co.tz'),
];
