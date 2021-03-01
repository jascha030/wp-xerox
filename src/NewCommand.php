<?php

namespace Jascha030\WPXerox;

use Composer\Command\CreateProjectCommand;
use Composer\Composer;
use Composer\Factory;
use Composer\IO\ConsoleIO;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\HelperSet;
use Symfony\Component\Console\Input\ArgvInput;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\ConsoleOutput;
use Symfony\Component\Console\Output\OutputInterface;

final class NewCommand extends Command
{
    public const PROJECT = 'jascha030/wp-plugin-boilerplate';

    private Composer $composer;

    private ConsoleIO $io;

    public function configure(): void
    {
        $this->addArgument('name', InputArgument::REQUIRED, 'The project title');
        $this->addArgument('package name', InputArgument::REQUIRED, 'The full name for composer {vendor}/{package}');
        // $this->addOption('theme', 't', InputOption::OPTIONAL, 'Project is a theme instead of a plugin');
    }

    public function getComposer(): Composer
    {
        if (isset($this->composer)) {
            return $this->composer;
        }

        $this->io       = new ConsoleIO(new ArgvInput(), new ConsoleOutput(), new HelperSet());
        $this->composer = Factory::create($this->io);

        return $this->composer;
    }

    protected function execute(InputInterface $input, OutputInterface $output): void
    {
        $name          = $input->getArgument('name');
        $directory     = $name !== '.' ? getcwd().'/'.$name : '.';
        $createCommand = $this->getCreateCommand();

        $createCommand->installProject(
            $this->io,
            Factory::createConfig(),
            new ArgvInput(),
            self::PROJECT,
            $directory
        );
    }

    private function getCreateCommand(): CreateProjectCommand
    {
        $composer      = $this->getComposer();
        $createCommand = new CreateProjectCommand();

        $createCommand->setComposer($composer);

        return $createCommand;
    }
}
