<?php

declare(strict_types=1);

namespace App\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;

class PhinxCommand extends Command
{
    private string $root = "php vendor/bin/phinx";

    protected function configure()
    {
        $this
            ->setName('phinx')
            ->setDescription('Run phinx commands')
            ->addArgument('args', InputArgument::REQUIRED, 'phinx commands');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $args = $input->getArgument('args');
        
        ## Use PHP defaults
        $output = array();
        $exit_code = null;
        exec("{$this->root} {$args}", $output, $exit_code);
        
        ## Output the results
        echo "Output:\n";
        echo implode("\n", $output) . "\n";
        echo "Exit code: " . $exit_code . "\n";
        
        return 1;
    }
}
