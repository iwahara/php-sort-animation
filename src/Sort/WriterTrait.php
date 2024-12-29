<?php

namespace Masaki\PhpSortAnimation\Sort;

use Symfony\Component\Console\Cursor;
use Symfony\Component\Console\Output\OutputInterface;

trait WriterTrait
{
    private function writeArray(OutputInterface $output,array $arr): void
    {
        $cursor = new Cursor($output);
        $cursor->hide();

        $cursor->clearScreen();

        foreach ($arr as $value) {
            $output->writeln(str_repeat('■', $value));
        }
        $cursor->show();
        usleep(200 * 1000);
    }
}