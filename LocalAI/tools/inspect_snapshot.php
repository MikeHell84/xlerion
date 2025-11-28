<?php
$path = 'x:\\temp_blog32.html';
$s = file_get_contents($path);
echo "LENGTH:" . strlen($s) . "\n";
echo "COUNT_WRAP:" . substr_count($s, 'blog-card-wrap') . "\n";
echo "---HEAD---\n";
echo substr($s,0,3000);
