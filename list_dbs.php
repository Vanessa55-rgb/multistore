<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$dbs = DB::select('SHOW DATABASES');
foreach ($dbs as $db) {
    echo $db->Database . PHP_EOL;
}
