<?php

declare(strict_types=1);

namespace GameOfLife;

final class GameOfLife
{
    public function run(string $input): void
    {
        while (1) {
            sleep(1);
            system('clear');
            print $input;
            print "Printing timestamp just so you know the script is running " . time();
        }
    }

    public function test(): string {
        return 'not working';
    }
}
