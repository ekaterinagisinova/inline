<?php
    $user = 'mysql';
    $password = 'mysql';
    $db = 'test';
    $host = 'localhost';

    $dsn='mysql:host='.$host.';dbname='.$db;
    $pdo = new PDO($dsn, $user, $password);

?>