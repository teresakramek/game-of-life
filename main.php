<?php

declare(strict_types=1);

require_once 'vendor/autoload.php';

use GameOfLife\GameOfLife;
use GameOfLife\Service\GameOfLifeResolver;

if (!isset($argv[1])) {
    exit("No input file provided\n");
}

$filename = $argv[1];

$input = file_get_contents($filename);
$game = new GameOfLife(new GameOfLifeResolver());
$game->run($input);
