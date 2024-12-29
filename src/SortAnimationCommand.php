<?php

namespace Masaki\PhpSortAnimation;

use Masaki\PhpSortAnimation\Sort\BubbleSort;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(name: 'app:sort')]
class SortAnimationCommand extends Command
{

    protected function configure(): void
    {
        $this
            ->setDescription('Greets the user.')
            ->setHelp('This command allows you to greet the user...')
            ->addArgument('name', InputArgument::OPTIONAL, 'ソートの種類');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $name = $input->getArgument('name') ?? 'World';
        $message = "Hello, $name!";

        $output->writeln($message);
        $sort = new BubbleSort($output);

        $unsortedArray = [];
        for ($i = 1; $i <= 10; $i++)
        {
            $unsortedArray[] = $i;
        }
        shuffle($unsortedArray);
        $origin = $unsortedArray;

        $sorted = $sort->bubbleSort($unsortedArray);

        $output->writeln('ソート前'.implode(',',$origin));
        $output->writeln('ソート後'.implode(',',$sorted));

        return Command::SUCCESS;
    }

}