<?php

declare(strict_types=1);

namespace App\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class PestCommand extends Command
{
    private string $root = "php ./vendor/bin/pest";

    protected function configure()
    {
        $this
            ->setName('pest')
            ->setDescription('Run pest tests');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        ## Use PHP defaults
        $output = array();
        $exit_code = null;
        exec("{$this->root}", $output, $exit_code);

        ## Output the results
        echo "Output:\n";
        echo implode("\n", $output) . "\n";
        echo "Exit code: " . $exit_code . "\n";

        return 1;
    }
}
