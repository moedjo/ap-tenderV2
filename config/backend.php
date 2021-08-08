<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Backend URI prefix
    |--------------------------------------------------------------------------
    |
    | Specifies the URL name used for accessing backend pages.
    | For example: backend -> http://localhost/backend
    |
    */

    'uri' => env('BACKEND_URI', 'backend'),

    /*
    |--------------------------------------------------------------------------
    | Backend Skin
    |--------------------------------------------------------------------------
    |
    | Specifies the backend skin class to use.
    |
    */

    'skin' => 'Backend\Skins\Standard',

    /*
    |--------------------------------------------------------------------------
    | Default Branding
    |--------------------------------------------------------------------------
    |
    | The default backend customization settings. These values are all optional
    | and remember to set the enabled value to true.
    |
    */

    'brand' => [
        'enabled' => true,
        'app_name' => 'PT Angkasa Pura I (Persero)',
        'tagline' => 'PT Angkasa Pura I (Persero)',
        'menu_mode' => 'inline',
        'favicon_path' => '~/plugins/ap/tender/assets/images/logo.png',
        'logo_path' => '~/plugins/ap/tender/assets/images/logo.png',
        'stylesheet_path' => '~/app/assets/less/styles.less',
        'login_background_type' => 'color',
        'login_background_color' => '#fef6eb',
        'login_background_wallpaper_size' => 'auto',
        'login_image_type' => 'custom',
        'login_custom_image' => '~/plugins/ap/tender/assets/images/logo.png',
    ],

    /*
    |--------------------------------------------------------------------------
    | Force HTTPS security
    |--------------------------------------------------------------------------
    |
    | Use this setting to force a secure protocol when accessing any backend
    | pages, including the authentication pages. This is usually handled by
    | web server config, but can be handled by the app for added security.
    |
    */

    'force_secure' => false,

    /*
    |--------------------------------------------------------------------------
    | Remember Login
    |--------------------------------------------------------------------------
    |
    | Define live duration of backend sessions:
    |
    | true  - session never expire (cookie expiration in 5 years)
    |
    | false - session have a limited time (see session.lifetime)
    |
    | null  - The form login display a checkbox that allow user to choose
    |         wanted behavior
    |
    */

    'force_remember' => true,

    /*
    |--------------------------------------------------------------------------
    | Backend Timezone
    |--------------------------------------------------------------------------
    |
    | This acts as the default setting for a backend user's timezone. This can
    | be changed by the user at any time using the backend preferences. All
    | dates displayed in the backend will be converted to this timezone.
    |
    */

    'timezone' => 'UTC',

];
