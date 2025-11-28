<?php
$path = 'x:\\temp_blog32.html';
if (!file_exists($path)) { echo "SNAPSHOT_MISSING\n"; exit(1); }
$s = file_get_contents($path);
$projects = [
  'Total Darkness – Pelijuego Interactivo',
  'Xlerion Toolkit',
  'Participación en Colombia 4.0',
  'Postulación a CoCrea 2025'
];
foreach ($projects as $p) {
  $found = (strpos($s, $p) !== false) ? 'FOUND' : 'MISSING';
  echo $found . ': ' . $p . "\n";
}
// Also print how many blog-card-wrap occurrences
echo "CARD_WRAPS_IN_SNAPSHOT: " . substr_count($s, 'blog-card-wrap') . "\n";
