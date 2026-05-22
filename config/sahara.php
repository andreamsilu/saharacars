<?php

$marketplaceDefaults = require __DIR__.'/marketplace_defaults.php';

return [
    /*
    |--------------------------------------------------------------------------
    | Registered legal name (e.g. top bar ticker on the public site)
    |--------------------------------------------------------------------------
    */
    'legal_entity_name' => env('SAHARA_LEGAL_NAME', 'SAHARA AUTOLINK TZ LIMITED'),

    /*
    |--------------------------------------------------------------------------
    | Public WhatsApp (E.164 without +, digits only)
    |--------------------------------------------------------------------------
    */
    'whatsapp_phone' => env('SAHARA_WHATSAPP_PHONE', '255791666101'),

    /*
    |--------------------------------------------------------------------------
    | Public support email (report listing, inquiries)
    |--------------------------------------------------------------------------
    */
    'support_email' => env('SAHARA_SUPPORT_EMAIL', 'info@saharaautolink.co.tz'),

    /*
    |--------------------------------------------------------------------------
    | Public website and social (footer, contact page)
    |--------------------------------------------------------------------------
    */
    'public_site_url' => $marketplaceDefaults['public_site_url'],

    'instagram_url' => $marketplaceDefaults['instagram_url'],

    /** Shown next to the Instagram icon (e.g. @handle from signage). Admin → Settings. */
    'instagram_label' => $marketplaceDefaults['instagram_label'],

    /** Visible link text when a profile URL exists but admin leaves the handle blank. */
    'instagram_fallback_caption' => 'Instagram',

    'facebook_url' => $marketplaceDefaults['facebook_url'],

    /** Shown next to the Facebook icon (e.g. page name). Admin → Settings. */
    'facebook_label' => $marketplaceDefaults['facebook_label'],

    'facebook_fallback_caption' => 'Facebook',

    /*
    |--------------------------------------------------------------------------
    | Brand line (physical signage slogan; shown e.g. in footer intro)
    |--------------------------------------------------------------------------
    */
    'brand_tagline' => env('SAHARA_BRAND_TAGLINE', 'Car sales · Car rental · Car importation'),

    /*
    |--------------------------------------------------------------------------
    | Primary location label (city / country as on signage)
    |--------------------------------------------------------------------------
    */
    'primary_location_label' => env('SAHARA_PRIMARY_LOCATION_LABEL', 'Dar es Salaam · Tanzania'),

    /*
    |--------------------------------------------------------------------------
    | Contact page: Google Maps embed (iframe src) and optional directions link
    |--------------------------------------------------------------------------
    | Embed must be the full https://www.google.com/maps/embed?... URL from the
    | Maps “Share → Embed a map” snippet. Directions URL should open Google Maps
    | navigation to the same pin (e.g. /dir/?api=1&destination=lat,lng).
    */
    'contact_map_embed_url' => $marketplaceDefaults['contact_map_embed_url'],

    'contact_map_directions_url' => $marketplaceDefaults['contact_map_directions_url'],

    /** Optional plain-text landmarks (overrides lang defaults when non-empty). */
    'office_location_notes' => env('SAHARA_OFFICE_LOCATION_NOTES', ''),

    /*
    |--------------------------------------------------------------------------
    | Footer (optional paragraph under tagline; hours line — admin can override all)
    |--------------------------------------------------------------------------
    */
    'footer_intro_extra' => env('SAHARA_FOOTER_INTRO_EXTRA', ''),
    'footer_hours_summary' => env('SAHARA_FOOTER_HOURS_SUMMARY', 'Mon–Sat, 08:00–18:00'),

    /*
    |--------------------------------------------------------------------------
    | About page: owner welcome video (iframe embed URL only)
    |--------------------------------------------------------------------------
    | Use a full embed URL, e.g. https://www.youtube.com/embed/VIDEO_ID
    | or https://player.vimeo.com/video/VIDEO_ID — not a watch-page link.
    */
    'about_owner_video_embed_url' => $marketplaceDefaults['about_owner_video_embed_url'],

    /*
    |--------------------------------------------------------------------------
    | Why choose us page: optional founder message (iframe embed URL only)
    |--------------------------------------------------------------------------
    | Same rules as about_owner_video_embed_url. Falls back to the About embed
    | if unset so one video can serve both pages when desired.
    */
    'why_choose_us_owner_video_embed_url' => $marketplaceDefaults['why_choose_us_owner_video_embed_url'],
];
