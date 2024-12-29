<?php

namespace Masaki\PhpSortAnimation\Sort;

use Symfony\Component\Console\Output\OutputInterface;

class HeapSort implements Sort
{
    use WriterTrait;

    private OutputInterface $output;

    private int $count = 0;

    public function __construct(OutputInterface $output)
    {
        $this->output = $output;
    }

    public function Sort(array $arr): array
    {
        $n = count($arr);

        // ヒープを構築
        for ($i = floor($n / 2) - 1; $i >= 0; $i--) {
            $arr = $this->heapify($arr, $n, $i);
        }

        // ヒープから1つずつ要素を取り出してソート
        for ($i = $n - 1; $i > 0; $i--) {
            // 現在の最大値を末尾と交換
            $arr = $this->swap($arr, 0, $i);

            // ヒープのサイズを1つ減らして再調整
            $arr = $this->heapify($arr, $i, 0);
        }

        return $arr;
    }

    // ヒープのプロパティを維持
    private function heapify(array $arr, int $n, int $i): array
    {
        $largest = $i;
        $left = 2 * $i + 1;
        $right = 2 * $i + 2;

        // 左の子が根より大きい場合
        if ($left < $n && $arr[$left] > $arr[$largest]) {
            $largest = $left;
        }

        // 右の子が根より大きい場合
        if ($right < $n && $arr[$right] > $arr[$largest]) {
            $largest = $right;
        }

        // 根が最も大きくない場合、交換して再調整
        if ($largest !== $i) {
            $arr = $this->swap($arr, $i, $largest);
            $arr = $this->heapify($arr, $n, $largest); // 再帰的な呼び出しもコピーで処理
        }

        return $arr;
    }

    // 配列の2つの要素を交換
    private function swap(array $arr, int $i, int $j): array
    {
        $temp = $arr[$i];
        $arr[$i] = $arr[$j];
        $arr[$j] = $temp;
        $this->writeArray($this->output, $arr);
        return $arr;
    }
}