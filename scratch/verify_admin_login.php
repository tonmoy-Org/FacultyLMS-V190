<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\Auth;

$phoneAttempt = Auth::attempt(['phone' => '01700000000', 'password' => '123456']);
echo "Phone Auth Status: " . ($phoneAttempt ? "SUCCESS" : "FAILED") . "\n";

$emailAttempt = Auth::attempt(['email' => 'admin01700@gmail.com', 'password' => '123456']);
echo "Email Auth Status: " . ($emailAttempt ? "SUCCESS" : "FAILED") . "\n";
