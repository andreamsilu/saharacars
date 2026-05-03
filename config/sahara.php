<?php

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
    'public_site_url' => env('SAHARA_PUBLIC_SITE_URL', 'https://www.saharaautolink.co.tz'),

    'instagram_url' => env('SAHARA_INSTAGRAM_URL', 'https://www.instagram.com/saharaautolinktz/'),

    /** Shown next to the Instagram icon (e.g. @handle from signage). */
    'instagram_label' => env('SAHARA_INSTAGRAM_LABEL', '@saharaautolinktz'),

    /** Visible link text when a profile URL exists but admin leaves the handle blank. */
    'instagram_fallback_caption' => env('SAHARA_INSTAGRAM_FALLBACK_CAPTION', 'Instagram'),

    /*
    |--------------------------------------------------------------------------
    | Brand line (physical signage slogan; shown e.g. in footer intro)
    |--------------------------------------------------------------------------
    */
    'brand_tagline' => env('SAHARA_BRAND_TAGLINE', 'Driven by Trust, Powered by Excellence'),

    /*
    |--------------------------------------------------------------------------
    | Primary location label (city / country as on signage)
    |--------------------------------------------------------------------------
    */
    'primary_location_label' => env('SAHARA_PRIMARY_LOCATION_LABEL', 'Dar es Salaam · Tanzania'),

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
    'about_owner_video_embed_url' => env('SAHARA_ABOUT_OWNER_VIDEO_EMBED', ''),

    /*
    |--------------------------------------------------------------------------
    | Why choose us page: optional founder message (iframe embed URL only)
    |--------------------------------------------------------------------------
    | Same rules as about_owner_video_embed_url. Falls back to the About embed
    | if unset so one video can serve both pages when desired.
    */
    'why_choose_us_owner_video_embed_url' => env(
        'SAHARA_WHY_CHOOSE_US_VIDEO_EMBED',
        env('SAHARA_ABOUT_OWNER_VIDEO_EMBED', '')
    ),
];
