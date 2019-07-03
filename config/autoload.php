<?php
// Autoloader paths
$paths = [
    'app/classes',
    'app/classes/minify',
    'app/controllers',
    'app/helpers',
    'app/mailer',
    'app/models',
    'app/polices',
    'lib',
    'tests/factories',
    'app/triats',
];

// Modules
$modules = [
    'order'
];

foreach ($modules as $module) {
    $paths[] = 'app/modules/' . $module . '/classes';
    $paths[] = 'app/modules/' . $module . '/controllers';
    $paths[] = 'app/modules/' . $module . '/helpers';
    $paths[] = 'app/modules/' . $module . '/mailers';
    $paths[] = 'app/modules/' . $module . '/models';
    $paths[] = 'app/modules/' . $module . '/policies';
    $paths[] = 'app/modules/' . $module . '/cron';
    $paths[] = 'app/modules/' . $module . '/traits';
    $paths[] = 'tests/modules/' . $module . '/factories';
}

// Custom paths
// $paths[] = 'app/modules/allegro/classes/resources';

include 'vendor/boooklet/framework/src/Autoloader.php';
foreach ($paths as $path) {
    $loader = new Autoloader($path);
    spl_autoload_register([$loader, 'autoload']);
}

// Composer autoload
require_once('vendor/autoload.php');
