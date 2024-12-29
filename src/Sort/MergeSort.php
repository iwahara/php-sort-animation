<?php

namespace Masaki\PhpSortAnimation\Sort;

use Symfony\Component\Console\Output\OutputInterface;

class MergeSort implements Sort
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

        // 1要素または空配列はそのまま返す
        if ($n <= 1) {
            return $arr;
        }

        // 配列を分割するサイズを決める
        $size = 1;

        // 配列をサイズごとに分割してマージ
        while ($size < $n) {
            // 分割した部分配列をマージしていく
            for ($left = 0; $left < $n; $left += 2 * $size) {
                // 左側の配列の終わり位置
                $mid = min($left + $size - 1, $n - 1);

                // 右側の配列の開始位置
                $right = min($left + 2 * $size - 1, $n - 1);

                // マージ
                $this->merge($arr, $left, $mid, $right);
                $this->writeArray($this->output, $arr);
            }

            // サイズを2倍にして次のステップへ進む
            $size *= 2;
        }

        return $arr;
    }

    // 2つの部分配列をマージする
    private function merge(array &$arr, int $left, int $mid, int $right): void
    {
        // 左側と右側の部分配列を作成
        $leftArr = array_slice($arr, $left, $mid - $left + 1);
        $rightArr = array_slice($arr, $mid + 1, $right - $mid);

        $i = 0;
        $j = 0;
        $k = $left;

        // 2つの部分配列をマージ
        while ($i < count($leftArr) && $j < count($rightArr)) {
            if ($leftArr[$i] <= $rightArr[$j]) {
                $arr[$k] = $leftArr[$i];
                $i++;
            } else {
                $arr[$k] = $rightArr[$j];
                $j++;
            }
            $k++;
        }

        // 左側の部分配列が残っている場合
        while ($i < count($leftArr)) {
            $arr[$k] = $leftArr[$i];
            $i++;
            $k++;
        }

        // 右側の部分配列が残っている場合
        while ($j < count($rightArr)) {
            $arr[$k] = $rightArr[$j];
            $j++;
            $k++;
        }
    }
}