<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

/**
 * Class AddTagCommand
 * @package App\Command
 */
class AddTagCommand extends Command
{
    protected static $defaultName = 'add-tag';

    protected function configure()
    {
        $this
            ->setDescription('Creates a new tag')
            ->addArgument('name', InputArgument::OPTIONAL, 'The tag name');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        $name = $input->getArgument('name');

        if ($name) {
            $io->note(sprintf('You passed an argument: %s', $name));
        }

        // TODO @gritt, implement AddTagCommand to create new tags using symfony's bin/console

        $io->success('Tag created successfully!');
    }
}
