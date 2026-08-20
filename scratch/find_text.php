<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$settings = DB::table('settings')->get();
foreach ($settings as $s) {
    if (preg_match('/[\x{0980}-\x{09FF}]/u', $s->value)) {
        echo "SETTING: " . $s->name . " => " . mb_substr(strip_tags($s->value), 0, 80) . "\n";
    }
}

$courses = DB::table('courses')->get();
foreach ($courses as $c) {
    if (preg_match('/[\x{0980}-\x{09FF}]/u', $c->masterclass_settings ?? '')) {
        echo "COURSE MC: " . $c->title . "\n";
        echo $c->masterclass_settings . "\n";
    }
}
