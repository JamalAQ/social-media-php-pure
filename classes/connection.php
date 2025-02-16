<?php

$dsn = 'mysql:host=localhost;dbname=eco';

$user ='root' ;

$pass = '';

try {
    $db = new PDO($dsn,$user,$pass);
    $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
}

catch (PDOException $e) {
    echo 'Faild' .$e->getmessage();
}


