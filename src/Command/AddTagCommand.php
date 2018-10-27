<?php

namespace App\Command;

use App\Entity\Tag;
use Doctrine\ORM\EntityManagerInterface;
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
    /**
     * @var string
     */
    protected static $defaultName = 'add-tag';

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;


    /**
     * AddTagCommand constructor.
     * @param EntityManagerInterface $em
     * @param null $name
     */
    public function __construct(EntityManagerInterface $em, $name = null)
    {
        $this->entityManager = $em;

        parent::__construct($name);
    }

    /**
     * Set description and arguments
     */
    protected function configure()
    {
        $this
            ->setDescription('Creates a new tag')
            ->addArgument('name', InputArgument::OPTIONAL, 'The tag name');
    }

    /**
     * Creates a tag entity and persist
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return void
     */
    protected function execute(InputInterface $input, OutputInterface $output): void
    {
        $io = new SymfonyStyle($input, $output);

        $name = $input->getArgument('name');
        if (!$name) {
            $io->error('Missing name argument, try: php bin/console add-tag Cats');
            return;
        }

        $tag = new Tag();
        $tag->setName($name);

        $this->entityManager->persist($tag);
        $this->entityManager->flush();

        $io->success('Tag: "' . $name . '" created successfully!');
    }
}
