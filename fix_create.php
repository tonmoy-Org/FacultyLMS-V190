<?php
$file = 'resources/views/backend/admin/course/create.blade.php';
$content = file_get_contents($file);

// Fix backslashes
$content = str_replace('__(\\\'2\\\')', '__(\'2\')', $content);
$content = str_replace('__(\\\'3\\\')', '__(\'3\')', $content);
$content = str_replace('__(\\\'4\\\')', '__(\'4\')', $content);
$content = str_replace('__(\\\'5\\\')', '__(\'5\')', $content);

// Update remaining digits if they weren't updated
$content = preg_replace('/(<span[^>]*>)\{\{\s*__\(\'2\'\)\s*\}\}(<\/span>\{\{\s*__\(\'media_images\'\)\s*\}\})/', '${1}{{ __(\'3\') }}$2', $content);
$content = preg_replace('/(<span[^>]*>)\{\{\s*__\(\'3\'\)\s*\}\}(<\/span>\{\{\s*__\(\'pricing\'\)\s*\}\})/', '${1}{{ __(\'4\') }}$2', $content);
$content = preg_replace('/(<span[^>]*>)\{\{\s*__\(\'4\'\)\s*\}\}(<\/span>\{\{\s*__\(\'seo\'\)\s*\}\})/', '${1}{{ __(\'5\') }}$2', $content);

file_put_contents($file, $content);
echo "Fixed backslashes and numbers in create.blade.php\n";
