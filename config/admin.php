<?php

return [
    /*
     * Admin login credentials.
     *
     * Best practice: store ONLY a password hash (bcrypt/argon) in environment variables.
     * Generate a bcrypt hash with:
     *   php -r "echo password_hash('your-password-here', PASSWORD_BCRYPT) . PHP_EOL;"
     */
    'email' => env('ADMIN_EMAIL', 'admin@saharacars.test'),
    'password_hash' => env('ADMIN_PASSWORD_HASH', ''),
];

