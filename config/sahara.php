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

    /*
    |--------------------------------------------------------------------------
    | About page: owner welcome video (iframe embed URL only)
    |--------------------------------------------------------------------------
    | Use a full embed URL, e.g. https://www.youtube.com/embed/VIDEO_ID
    | or https://player.vimeo.com/video/VIDEO_ID — not a watch-page link.
    */
    'about_owner_video_embed_url' => env('SAHARA_ABOUT_OWNER_VIDEO_EMBED', ''),
];
