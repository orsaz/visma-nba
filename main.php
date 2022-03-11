#!/usr/bin/env php
<?php

require_once 'vendor/autoload.php';

$bootstrap = new \App\Bootstrap();

try {
    $bootstrap($argv);
} catch (App\Exceptions\InvalidCommandException $exception) {
    echo $exception->getMessage();
    echo "\n";
}
