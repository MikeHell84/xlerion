<?php
require __DIR__ . '/../vendor/autoload.php';
$pdo = new PDO('sqlite:' . __DIR__ . '/../database/database.sqlite');
$rows = $pdo->query('select email from users');
foreach ($rows as $r) {
    echo $r['email'] . PHP_EOL;
}
