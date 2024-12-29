<?php

namespace Masaki\PhpSortAnimation\Sort;

use Symfony\Component\Console\Output\OutputInterface;

class QuickSort implements Sort
{
    use WriterTrait;

    private OutputInterface $output;

    public function __construct(OutputInterface $output)
    {
        $this->output = $output;
    }

    public function Sort(array $arr): array
    {

        $stack = [];
        $stack[] = [0, count($arr) - 1]; // 初期のインデックス範囲をスタックに追加

        while (!empty($stack)) {
            // スタックから範囲を取り出す
            list($low, $high) = array_pop($stack);

            if ($low < $high) {
                // ピボットを選択して分割
                $pivotIndex = $this->partition($arr, $low, $high);

                // 左側の部分配列をスタックに追加
                $stack[] = [$low, $pivotIndex - 1];

                // 右側の部分配列をスタックに追加
                $stack[] = [$pivotIndex + 1, $high];
            }
        }

        return $arr;
    }

    private function partition(array &$arr, int $low, int $high): int
    {
        $pivot = $arr[$high];  // ピボットは右端の要素
        $i = $low - 1;  // iは左側のインデックス

        for ($j = $low; $j < $high; $j++) {
            // 現在の要素がピボットより小さい場合
            if ($arr[$j] <= $pivot) {
                $i++;  // インデックスを進める
                // 要素を交換
                list($arr[$i], $arr[$j]) = [$arr[$j], $arr[$i]];
                $this->writeArray($this->output, $arr);
            }
        }

        // ピボットとi+1の要素を交換してピボットを正しい位置に配置
        list($arr[$i + 1], $arr[$high]) = [$arr[$high], $arr[$i + 1]];
        $this->writeArray($this->output, $arr);

        return $i + 1;  // ピボットのインデックスを返す
    }
}