<?php

namespace App\Command;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class ShowProductCommand extends Command
{
    protected static $defaultName = 'app:show-product';
    private ProductRepository $repository;

    public function __construct(string $name = null, ProductRepository $repository)
    {
        parent::__construct($name);

        $this->repository = $repository;
    }

    protected function configure()
    {
        $this
            ->setDescription('Shows a product by uuid')
            ->addArgument('uuid', InputArgument::OPTIONAL, 'uuidv4 of a product to show')
            ->addOption('all', null, InputOption::VALUE_NONE, 'show all products (ignores uuid argument)')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        if ($input->getOption('all')) {
            $products = $this->repository->findAll();
        } else {
            $uuid = $input->getArgument('uuid');
            if (!$uuid) {
                $io->note('no uuid provided');
                return Command::FAILURE;
            }

            $products = [
                $this->repository->find($uuid)
            ];
        }

        $io->table(
            ['uuid', 'name'],
            array_map(
                static fn(Product $product) => [$product->getUuid(), $product->getName()],
                $products
            )
        );

        return Command::SUCCESS;
    }
}
