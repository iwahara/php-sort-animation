<?php

namespace Masaki\PhpSortAnimation\Sort;

use Symfony\Component\Console\Cursor;
use Symfony\Component\Console\Output\OutputInterface;

class BubbleSort implements Sort
{
    use WriterTrait;

    private OutputInterface $output;

    public function __construct(OutputInterface $output)
    {
        $this->output = $output;
    }

    public function Sort(array $arr): array
    {
        $n = count($arr);
        for ($i = 0; $i < $n - 1; $i++) {
            for ($j = 0; $j < $n - $i - 1; $j++) {
                if ($arr[$j] > $arr[$j + 1]) {
                    // 要素を入れ替える
                    $temp = $arr[$j];
                    $arr[$j] = $arr[$j + 1];
                    $arr[$j + 1] = $temp;

                    $this->writeArray($this->output, $arr);
                }

            }
        }
        return $arr;
    }

}