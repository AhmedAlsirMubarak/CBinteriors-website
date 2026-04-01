<?php

return [

    /*
    |--------------------------------------------------------------------------
    | CB Interiors — Project Config
    |--------------------------------------------------------------------------
    */

    // Currency display
    'currency'        => env('CB_CURRENCY', 'OMR'),
    'currency_locale' => env('CB_CURRENCY_LOCALE', 'ar-OM'),

    // Image upload limits (KB)
    'max_image_size'  => env('CB_MAX_IMAGE_SIZE', 4096),

    // Pagination
    'products_per_page' => env('CB_PRODUCTS_PER_PAGE', 12),
    'services_per_page' => env('CB_SERVICES_PER_PAGE', 9),

    // Admin
    'admin_email'     => env('CB_ADMIN_EMAIL', 'admin@cbinteriors.com'),

    // Cache TTL in seconds
    'settings_cache_ttl' => env('CB_SETTINGS_CACHE_TTL', 3600),

];