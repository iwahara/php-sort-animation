<?php

namespace Masaki\PhpSortAnimation\Sort;

use Symfony\Component\Console\Cursor;
use Symfony\Component\Console\Output\OutputInterface;

class BubbleSort
{
    private OutputInterface $output;

    public function __construct(OutputInterface $output)
    {
        $this->output = $output;
    }

    public function bubbleSort(array $arr): array
    {
        $n = count($arr);
        $count = 0;
        for ($i = 0; $i < $n - 1; $i++) {
            for ($j = 0; $j < $n - $i - 1; $j++) {
                if ($arr[$j] > $arr[$j + 1]) {
                    // 要素を入れ替える
                    $temp = $arr[$j];
                    $arr[$j] = $arr[$j + 1];
                    $arr[$j + 1] = $temp;

                    $this->writeArray($arr);
                    usleep(200 * 1000);
                }
                $count++;
            }
        }
        $this->output->writeln("計算回数[$count]");
        return $arr;
    }

    private function writeArray(array $arr): void
    {
        $cursor = new Cursor($this->output);
        $cursor->hide();

        $cursor->clearScreen();

        foreach ($arr as $value) {
            $this->output->writeln(str_repeat('■', $value));
        }
        $cursor->show();
    }
}