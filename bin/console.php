#!/usr/bin/env php
<?php

require_once('/app/vendor/autoload.php');

use Symfony\Component\Dotenv\Dotenv;
use Symfony\Component\Console\Application;
use App\Command\TictactoeCommand;

$dotEnv = new Dotenv();
$dotEnv->load('/app/.env');

$app = new Application();
$app->add(new TictactoeCommand());
$app->run();