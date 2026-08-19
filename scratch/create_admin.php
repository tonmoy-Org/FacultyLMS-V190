<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\User;
use Illuminate\Support\Facades\Hash;

$adminRole = DB::table('roles')->where('id', 1)->first();
$permissions = $adminRole ? json_decode($adminRole->permissions, true) : [];

$user = User::where('phone', '01700000000')->first();
if (!$user) {
    $user = new User();
    $user->first_name = 'Admin';
    $user->last_name = 'User';
    $user->email = 'admin01700000000@gmail.com';
    $user->phone = '01700000000';
}

$user->password = Hash::make('123456');
$user->user_type = 'admin';
$user->role_id = 1;
$user->status = 1;
$user->is_user_banned = 0;
$user->is_deleted = 0;
$user->email_verified_at = now();

if (!empty($permissions)) {
    $user->permissions = $permissions;
}

$user->save();

echo "ADMIN_CREATED_SUCCESSFULLY\n";
echo "ID: " . $user->id . "\n";
echo "Email: " . $user->email . "\n";
echo "Phone: " . $user->phone . "\n";
echo "User Type: " . $user->user_type . "\n";
echo "Role ID: " . $user->role_id . "\n";
