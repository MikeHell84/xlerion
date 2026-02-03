<?php
if ($argc < 2) {
    echo "Usage: php check_email.php you@example.test\n";
    exit(1);
}
$email = $argv[1];
require __DIR__ . '/../vendor/autoload.php';
$pdo = new PDO('sqlite:' . __DIR__ . '/../database/database.sqlite');
$stmt = $pdo->prepare('select count(*) as c from users where email = ?');
$stmt->execute([$email]);
$r = $stmt->fetch(PDO::FETCH_ASSOC);
echo $r['c'] . PHP_EOL;
