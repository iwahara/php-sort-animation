<?php

namespace Masaki\PhpSortAnimation\Sort;

interface Sort
{
    public function Sort(array $arr): array;
    public function Count(): int;
}