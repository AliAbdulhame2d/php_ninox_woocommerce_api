<?php

return [

    // WooCommerce
    'woo_url' => 'https://example.com',
    'woo_key' => 'ck_xxxxx',
    'woo_secret' => 'cs_xxxxx',

    // Ninox
    'ninox_key' => 'xxxxx',
    'ninox_team' => 'xxxxx',
    'ninox_db' => 'xxxxx',
    'ninox_url' => 'https://api.ninox.com',

    // Mysql
    'db_host' => 'localhost',
    'db_user' => 'root',
    'db_pass' => '',
    'db_name' => 'testdb'

];




/* Alternative env Code (ist in diesem Projekt nich benutzt)

$config = [
    'woo_url' => $_ENV['WOO_URL'],
    'woo_key' => $_ENV['WOO_KEY'],
    'woo_secret' => $_ENV['WOO_SECRET'],

    'ninox_key' => $_ENV['NINOX_KEY'],
    'ninox_team' => $_ENV['NINOX_TEAM'],
    'ninox_db' => $_ENV['NINOX_DB'],
    'ninox_url' => $_ENV['NINOX_URL'],

    'db_host' => $_ENV['DB_HOST'],
    'db_user' => $_ENV['DB_USER'],
    'db_pass' => $_ENV['DB_PASS'],
    'db_name' => $_ENV['DB_NAME']
];

*/