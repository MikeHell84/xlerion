<?php
$s = @file_get_contents('x:\\temp_blog35.html');
if (!$s) { echo "MISSING_FILE\n"; exit(1); }
if (strpos($s, 'Adaptación de obra literaria original a una experiencia narrativa inmersiva') !== false) echo "PHRASE_PRESENT\n"; else echo "PHRASE_MISSING\n";
