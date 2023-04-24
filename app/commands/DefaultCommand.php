<?php

declare(strict_types=1);

namespace App\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;

class DefaultCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('serve')
            ->setDescription('Start application. Can take optional argument for port number e.g php command serve 8080')
            ->addArgument('port', InputArgument::OPTIONAL, 'port to serve application (defaults to 9001)');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $port = $input->getArgument('port') ?? 9001;

        $output->writeln(sprintf('Application will run on port:, %s!', $port));

        ## Use PHP defaults
        $output = array();
        $exit_code = null;
        exec("php -S localhost:{$port} -t public", $output, $exit_code);

        ## Output the results
        echo "Output:\n";
        echo implode("\n", $output) . "\n";
        echo "Exit code: " . $exit_code . "\n";

        return 1;
    }
}
