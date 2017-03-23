<?php

try{
    //$pdo = new PDO('mysql:dbname=u107319540_bdd;host=mysql.hostinger.fr','u107319540_root','tamere');
    $pdo = new PDO('mysql:dbname=cours_PHP;host=localhost','root','root');
} catch(PDOException $exception) {
    die($exception->getMessage());
}
$pdo->exec("SET NAMES UTF8");
