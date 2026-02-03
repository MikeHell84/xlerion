<?php
$db = __DIR__ . '/../database/database.sqlite';
if (!file_exists($db)) { echo "DB not found: $db\n"; exit(1); }
try {
    $pdo = new PDO('sqlite:' . $db);
    $stmt = $pdo->query('SELECT id, name, token, abilities, last_used_at, created_at, updated_at FROM personal_access_tokens ORDER BY id DESC LIMIT 20');
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if (!$rows) { echo "No tokens found.\n"; exit(0); }
    foreach ($rows as $r) {
        echo "id={$r['id']} name={$r['name']} token={$r['token']} last_used_at={$r['last_used_at']} created_at={$r['created_at']}\n";
    }
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage() . "\n";
}
