<?php
$path = $argv[1] ?? 'x:\\temp_blog34.html';
if (!file_exists($path)) { echo "MISSING\n"; exit(1); }
$s = file_get_contents($path);
$matches = [];
if (preg_match_all('~/media/images/parallax/([^"\'\s>]+)~i', $s, $m)) {
    $files = array_unique($m[1]);
    foreach ($files as $f) echo "PARALLAX:" . $f . "\n";
} else {
    echo "NO_PARALLAX_REFS\n";
}
