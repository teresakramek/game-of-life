<?php

declare(strict_types=1);

namespace GameOfLife;

use GameOfLife\Service\GameOfLifeResolver;

final class GameOfLife
{
    /**
     * @var GameOfLifeResolver
     */
    private $gameOfLifeResolver;

    public function __construct(GameOfLifeResolver $gameOfLifeResolver)
    {
        $this->gameOfLifeResolver = $gameOfLifeResolver;
    }

    public function run(string $input): void
    {
        $this->gameOfLifeResolver->setInput($input);

        while (1) {
            sleep(1);
            system('clear');
            print $input;

            $input = $this->gameOfLifeResolver->createLife();

            print "Printing timestamp just so you know the script is running " . time();
        }
    }

    public function test(): string {
        return 'not working';
    }
}
