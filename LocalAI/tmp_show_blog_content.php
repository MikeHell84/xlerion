<?php
$db = new PDO('sqlite:' . realpath(__DIR__ . '/xlerion_cmr/storage/database.sqlite'));
$st = $db->prepare('SELECT content FROM cms_pages WHERE slug = ? LIMIT 1');
$st->execute(['blog']);
$r = $st->fetch(PDO::FETCH_ASSOC);
if (!$r) { echo "no blog"; exit(0); }
echo substr($r['content'],0,800);
