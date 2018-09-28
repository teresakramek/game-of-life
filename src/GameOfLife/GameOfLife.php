<?php

declare(strict_types=1);

namespace GameOfLife;

final class GameOfLife
{
    public function run(string $input): void
    {
        $board = array_filter(explode(PHP_EOL, $input));

        while (1) {
            sleep(1);
            system('clear');
            print $this->toString($board);

            $board = $this->nextIteration($board);

            print "Printing timestamp just so you know the script is running " . time();
        }
    }

    public function nextIteration($board)
    {
        $newBoard = [];

        foreach ($board as $x => $row) {

            if(is_string($row)) {
                $row = str_split($row);
            }


            foreach ($row as $y => $sign) {
                [$livingCells, $color] = $this->checkNeighbors($x, $y, $board);
                $newBoard[$x][$y] = $this->processCell($sign, $livingCells, $color);
            }
        }

        return $newBoard;
    }

    public function checkNeighbors($x, $y, $actualBoard) : array
    {
        $neighbors = [];
        $neighbors[] = $actualBoard[$x][$y-1] ?? '.';
        $neighbors[] = $actualBoard[$x][$y+1] ?? '.';

        $neighbors[] = $actualBoard[$x-1][$y] ?? '.';
        $neighbors[] = $actualBoard[$x-1][$y-1] ?? '.';
        $neighbors[] = $actualBoard[$x-1][$y+1] ?? '.';

        $neighbors[] = $actualBoard[$x+1][$y] ?? '.';
        $neighbors[] = $actualBoard[$x+1][$y-1] ?? '.';
        $neighbors[] = $actualBoard[$x+1][$y+1] ?? '.';

        $cells = array_filter($neighbors, function($value) { return $value !== '.'; });
        $counts = array_keys(array_count_values($cells));
        arsort($counts);

        $livingCells = count($cells);

        return [$livingCells, $counts[0] ?? 'A'];
    }

    /**
     * 22221. Any live cell with fewer than two live neighbours dies, as if caused by underpopulation.
     * 22222. Any live cell with more than three live neighbours dies, as if by overcrowding.
     * 22223. Any live cell with two or three live neighbours lives on to the next generation.
     * 22224. Any dead cell with exactly three live neighbours becomes a live cell.
     */
    public function processCell($sign, $livingCells, $color)
    {
        if ($sign !== '.') {
            if ($livingCells < 2 || $livingCells > 3) {
                $sign = '.';
            }
        } else if ($livingCells === 3) {
            $sign = $color;
        }

        return $sign;
    }

    private function toString($board) {
        $string = '';

        foreach ($board as $x => $row) {
            if (!is_string($row)) {
                $string .= implode('', $row) . PHP_EOL;
            }
        }

        $string = str_replace('A',"\033[32mx\e[37m", $string);
        $string = str_replace('B',"\033[34mx\e[37m", $string);
        $string = str_replace('C',"\033[31mx\e[37m", $string);
        $string = str_replace('D',"\033[33mx\e[37m", $string);

        return $string;
    }
}
