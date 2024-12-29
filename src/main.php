<?php

require __DIR__ . '/../vendor/autoload.php';

use Masaki\PhpSortAnimation\SortAnimationCommand;
use Symfony\Component\Console\Application;

// Symfony Console Applicationを作成
$application = new Application();

// カスタムコマンドを追加
$application->add(new SortAnimationCommand());

// 実行
$application->run();
