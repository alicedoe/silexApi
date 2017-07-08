<?php

// Doctrine (db)
$app['db.options'] = array(
    'driver'   => 'pdo_mysql',
    'charset'  => 'utf8',
    'host'     => 'localhost',
    'port'     => '3306',
    'dbname'   => 'circus',
    'user'     => 'root',
    'password' => 'root',
);

$app['api'] = array(
    'key'   => 'GYqF5VMiwCcplnlO3JWnU4NHcoX9ZmBk',
    'iss'   => 'http://www.apisilex.my'
);
