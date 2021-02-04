<?php

$user = 'php_user';
$pw = 'php_user';
$host = 'localhost';
$db = 'testdb';

try {
    $pdo = new PDO('mysql:host='.$host.';dbname='.$db, $user, $pw);
    
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die("Program crashed");
}