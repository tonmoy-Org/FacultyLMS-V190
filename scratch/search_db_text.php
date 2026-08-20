<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$tables = DB::select('SHOW TABLES');
$dbName = DB::getDatabaseName();
$prop = "Tables_in_" . $dbName;

foreach ($tables as $t) {
    $tableName = $t->$prop;
    try {
        $cols = DB::getSchemaBuilder()->getColumnListing($tableName);
        $query = DB::table($tableName);
        foreach ($cols as $col) {
            $query->orWhere($col, 'like', '%আমরা%')
                  ->orWhere($col, 'like', '%অনলাইন%')
                  ->orWhere($col, 'like', '%কোর্স%');
        }
        $results = $query->take(5)->get();
        if ($results->count() > 0) {
            foreach ($results as $res) {
                foreach ((array)$res as $col => $val) {
                    if (is_string($val) && (str_contains($val, 'আমরা বলতে চাই') || str_contains($val, 'অনলাইন কোর্স') || str_contains($val, 'প্রুভেন'))) {
                        echo "FOUND IN TABLE: $tableName | COL: $col\n";
                        echo "VAL: " . mb_substr(strip_tags($val), 0, 200) . "\n-----------------\n";
                    }
                }
            }
        }
    } catch (\Exception $e) {}
}
