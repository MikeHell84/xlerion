<?php
$db=new PDO('sqlite:' . __DIR__ . '/../xlerion_cmr/storage/database.sqlite');
$st=$db->prepare('SELECT content FROM cms_pages WHERE slug=?');
$st->execute(['blog']);
$r=$st->fetch(PDO::FETCH_ASSOC);
if ($r) {
    file_put_contents(__DIR__ . '/../temp_blog_db_content.html', $r['content']);
    echo 'DUMPED_DB_CONTENT_TO workspace/temp_blog_db_content.html\n';
} else {
    echo 'NO_BLOG_ROW\n';
}
