<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$user = new App\Models\User();
$user->first_name = 'Demo';
$user->last_name = 'Admin';
$user->email = 'admin@demo.com';
$user->phone = '01700000000';
$user->phone_country_id = 19;
$user->password = bcrypt('123456');
$user->role_id = 1;
$user->user_type = 'admin';
$user->status = 1;
$user->email_verified_at = now();
$user->save();

echo "Admin created. Phone: 01700000000 Password: 123456\n";
