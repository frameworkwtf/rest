<?php

declare(strict_types=1);
// Enable Composer autoloader
/** @var \Composer\Autoload\ClassLoader $autoloader */
$autoloader = require __DIR__.'/../vendor/autoload.php';

// Register test classes
$autoloader->addPsr4('Wtf\\Rest\\Tests\\', __DIR__);
