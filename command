#!/usr/bin/php
<?php

require_once 'vendor/autoload.php';

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
    \App\Commands\DefaultCommand::class,
    \App\Commands\PhinxCommand::class,
    \App\Commands\PestCommand::class,
    \App\Commands\GreetCommand::class,
];

$useTraits->childrenMustBeOfType($allCommands, ['string']);

foreach($allCommands as $command){
    $app->add(new $command);
};

# Run Commands
$app->run();
