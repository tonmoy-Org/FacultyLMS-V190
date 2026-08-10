<?php
$file = 'resources/views/backend/admin/course/edit.blade.php';
$content = file_get_contents($file);

$content = preg_replace('/(<span[^>]*?>)2(<\/span>\{\{\s*__\(\'media_images\'\)\s*\}\})/', '${1}3$2', $content);
$content = preg_replace('/(<span[^>]*?>)3(<\/span>\{\{\s*__\(\'pricing\'\)\s*\}\})/', '${1}4$2', $content);
$content = preg_replace('/(<span[^>]*?>)4(<\/span>\{\{\s*__\(\'seo\'\)\s*\}\})/', '${1}5$2', $content);
$content = preg_replace('/(<span[^>]*?>)5(<\/span>\s*\{\{\s*__\(\'curriculum\'\)\s*\}\})/', '${1}6$2', $content);
$content = preg_replace('/(<span[^>]*?>)6(<\/span>\s*\{\{\s*__\(\'Live Class\'\)\s*\}\})/', '${1}7$2', $content);

file_put_contents($file, $content);
echo "Numbers updated in edit.blade.php\n";
