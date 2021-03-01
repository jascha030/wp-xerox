<?php

namespace Jascha030\WPXerox;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;

final class NewCommand extends Command
{
    public function configure(): void
    {
        $this->addArgument('name', InputArgument::REQUIRED, 'The project title');
        $this->addArgument('package name', InputArgument::REQUIRED, 'The full name for composer {vendor}/{package}');
        // $this->addOption('theme', 't', InputOption::OPTIONAL, 'Project is a theme instead of a plugin');
    }
}
