<?php

/**
 * Serverless entry point for Vercel.
 *
 * Vercel Functions have a read-only filesystem. Laravel's runtime-generated
 * files therefore belong in /tmp, while cache, session, and queue state stay
 * in-memory until SonicWave is connected to persistent services.
 */
if (getenv('VERCEL') !== false) {
    $temporaryPath = rtrim(sys_get_temp_dir(), DIRECTORY_SEPARATOR);

    $defaults = [
        'APP_ENV' => 'production',
        'APP_DEBUG' => 'false',
        'LOG_CHANNEL' => 'stderr',
        'LOG_LEVEL' => 'warning',
        'CACHE_STORE' => 'array',
        'SESSION_DRIVER' => 'array',
        'QUEUE_CONNECTION' => 'sync',
        'VIEW_COMPILED_PATH' => "{$temporaryPath}/views",
        'APP_CONFIG_CACHE' => "{$temporaryPath}/config.php",
        'APP_EVENTS_CACHE' => "{$temporaryPath}/events.php",
        'APP_PACKAGES_CACHE' => "{$temporaryPath}/packages.php",
        'APP_ROUTES_CACHE' => "{$temporaryPath}/routes.php",
        'APP_SERVICES_CACHE' => "{$temporaryPath}/services.php",
    ];

    foreach ($defaults as $key => $value) {
        if (getenv($key) === false) {
            putenv("{$key}={$value}");
            $_ENV[$key] = $value;
            $_SERVER[$key] = $value;
        }
    }
}

require __DIR__.'/../public/index.php';
