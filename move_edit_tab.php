<?php
$file = 'resources/views/backend/admin/course/edit.blade.php';
$content = file_get_contents($file);

$tabRegex = '/<li class="nav-item" role="presentation">\s*<a class="nav-link.*?id="masterclass".*?<\/li>/is';
if (preg_match($tabRegex, $content, $matches)) {
    $masterclassTab = $matches[0];
    $content = preg_replace($tabRegex, '', $content);
    
    $basicInfoTabRegex = '/(<li class="nav-item" role="presentation">\s*<a class="nav-link.*?id="basicInformation".*?<\/li>)/is';
    $content = preg_replace($basicInfoTabRegex, '$1' . PHP_EOL . $masterclassTab, $content);
    
    file_put_contents($file, $content);
    echo "Tab moved successfully in edit.blade.php\n";
} else {
    echo "Could not find masterclass tab\n";
}
?>
