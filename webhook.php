<?php

use Nette\Neon\Neon;
use Webhook\Hook;

include_once('vendor/autoload.php');

$configFile = __DIR__ . "/config.neon";
$config = (new Neon)->decode(file_get_contents($configFile));

$hook = new Hook($config['github']['secret']);

if(!file_exists($configFile)) {
    throw new Exception('Config file not found.');
}

if ($hook->isValidSignature()) {
    echo $hook->pull();
}