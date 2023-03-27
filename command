#!/usr/bin/php
<?php

require_once 'vendor/autoload.php';

use App\Commands\GreetCommand;
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
    GreetCommand::class
];

$useTraits->childrenMustBeOfType($allCommands, ['string']);

foreach($allCommands as $command){
    $app->add(new $command);
};

# Run Commands
$app->run();
