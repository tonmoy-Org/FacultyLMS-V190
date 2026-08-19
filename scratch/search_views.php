<?php
$dir = new RecursiveDirectoryIterator('resources/views');
$iterator = new RecursiveIteratorIterator($dir);
foreach ($iterator as $file) {
    if ($file->isFile() && $file->getExtension() === 'php') {
        $content = file_get_contents($file->getPathname());
        if (preg_match('/[\x{0980}-\x{09FF}]/u', $content)) {
            echo "FILE: " . $file->getPathname() . "\n";
            $lines = explode("\n", $content);
            foreach ($lines as $i => $line) {
                if (preg_match('/[\x{0980}-\x{09FF}]/u', $line)) {
                    echo "  Line " . ($i + 1) . ": " . trim($line) . "\n";
                }
            }
        }
    }
}
