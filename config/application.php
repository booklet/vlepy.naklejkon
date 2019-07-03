<?php
date_default_timezone_set('Europe/Warsaw');
setlocale(LC_MONETARY, 'pl_PL');

// Environment
include 'config/environment.php';
include 'config/environment/' . Config::get('env') . '.php';

include 'config/secret.php';

// TIME FOR DATABASE
Config::set('mysqltime', "Y-m-d H:i:s");

Config::set('package_size', 500);

Config::set('shipping_name', 'Kurier UPS');
Config::set('shipping_price', 15.00);


/* Mailing */
Config::set('mailing_address', 'info@booklet.pl');
Config::set('mailing_from_name', 'Vlepy.naklejkon.pl');
Config::set('mailing_from_email', 'info@booklet.pl');
Config::set('mailing_reply_to', 'info@booklet.pl');


// List of files to minify
Config::set('css_files', [
    //
    'fonts.css',

    // Plugins
    'plugin.slick.css',
    'plugin.slick.theme.css',
    'fontawesome.min.css',

    // Assets
    'asset.container.css',
    'asset.flexbox.css',
    'asset.form.css',
    'asset.buttons.css',
    'asset.alerts.css',

    //
    'application.css',

    // Layout
    'layout.header.css',
    'layout.footer.css',

    // Pages
    'page.order.new.css',

    //
    'block.products.css',
    'block.reviews.css',
    'block.insta-gallery.css',
    'block.advanteges.css',
    'block.newsletter.css',
    'block.order-form.css',
]);

Config::set('js_files', [
    //
    'jquery.min.js',

    // Plugins
    'slick.min.js',
    'instashow/elfsight-instagram-feed.js',
    'validator/dist/jquery.validate.min.js',
    'validator/dist/additional-methods.min.js',
    'validator/src/localization/messages_pl.js',

    //
    'application.js',
]);
