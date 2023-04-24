#!/usr/bin/php
<?php

require_once 'vendor/autoload.php';

use App\Commands\DefaultCommand;
use App\Commands\GreetCommand;
use App\Commands\PhinxCommand;
use Symfony\Component\Console\Application;

# Common Class to instanciate traits
class UseTraits {
    use App\Core\Traits\Utils\StrictArrayValidators;
};

$useTraits = new UseTraits();

# Init command line application
$app = new Application();

# Register Commands
$allCommands = [
    DefaultCommand::class,
    PhinxCommand::class,
    GreetCommand::class
];

$useTraits->childrenMustBeOfType($allCommands, ['string']);

foreach($allCommands as $command){
    $app->add(new $command);
};

# Run Commands
$app->run();
