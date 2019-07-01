<?php
date_default_timezone_set('Europe/Warsaw');
setlocale(LC_MONETARY, 'pl_PL');

// Environment
include 'config/environment.php';
include 'config/environment/' . Config::get('env') . '.php';

// List of files to minify
Config::set('css_files', [
    //
    'fonts.css',

    // Assets
    'asset.container.css',
    'asset.flexbox.css',

    //
    'application.css',

    //
    'block.header.css',
    'block.products.css',
]);

Config::set('js_files', [
    // Plugins
    'instashow/elfsight-instagram-feed.js',

    //
    'application.js',
]);

include 'config/secret.php';

// TIME FOR DATABASE
Config::set('mysqltime', "Y-m-d H:i:s");
