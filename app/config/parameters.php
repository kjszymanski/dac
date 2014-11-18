<?php
if (isset($_ENV['CLEARDB_DATABASE_URL'])) {
    $db = parse_url($_ENV['CLEARDB_DATABASE_URL']);
    var_dump($db);
    $container->setParameter('database_driver', 'pdo_mysql');
    $container->setParameter('database_host', $db['host']);
    if (isset($db['port']))
        $container->setParameter('database_port', $db['port']);
    if (isset($db['name']))
        $container->setParameter('database_name', trim($db['name'], '/'));
    $container->setParameter('database_user', $db['user']);
    $container->setParameter('database_password', $db['pass']);
}