<?php
$db = new PDO('sqlite:' . realpath(__DIR__ . '/xlerion_cmr/storage/database.sqlite'));
$st = $db->query('SELECT id,slug,title FROM cms_pages ORDER BY id DESC LIMIT 10');
$rows = $st->fetchAll(PDO::FETCH_ASSOC);
foreach ($rows as $r) {
    echo $r['id'] . "\t" . $r['slug'] . "\t" . $r['title'] . "\n";
}
