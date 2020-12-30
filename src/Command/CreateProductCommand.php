<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Doctrine\ORM\EntityManagerInterface;
Use App\Entity\Product;

class CreateProductCommand extends Command
{
    protected static $defaultName = 'app:create-product';

    private EntityManagerInterface $entityManager;

    public function __construct(string $name = null, EntityManagerInterface $entityManager)
    {
        parent::__construct($name);

        $this->entityManager = $entityManager;
    }

    protected function configure()
    {
        $this
            ->setDescription('Creates product')
            ->addArgument('name', InputArgument::OPTIONAL, 'product name')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $name = $input->getArgument('name');

        $product = new Product();
        $product->setName($name);
        $this->entityManager->persist($product);
        $this->entityManager->flush();

        $io->success("Product is created with uuid = {$product->getUuid()}");

        return Command::SUCCESS;
    }
}
