<?php

declare(strict_types=1);

namespace GameOfLife\Service;

use GameOfLife\Cell;
use GameOfLife\Exception\DataNotFoundException;

/**
 * Created by PhpStorm.
 * User: marcin
 * Date: 27.10.18
 * Time: 14:26
 */
class GameOfLifeResolver
{
    const LIVE_CELL = 'x';

    const DEAD_CELL = '.';

    private $areaOfLife;

    public function createLife()
    {
        if (empty($this->areaOfLife)) {
            throw new DataNotFoundException('can not find data in resolver');
        }

        $this->areaOfLife = $this->makeLife();

        return $this->toString();
    }

    public function setInput(string $input) : self
    {
        $this->areaOfLife = $this->toArray($input);

        return $this;
    }

    private function toArray($areaOfLife)
    {
        $areaOfLife = explode(PHP_EOL, $areaOfLife);

        foreach ($areaOfLife as $index => $row) {
            if (empty($row)) {
                 unset($areaOfLife[$index]);
            }
        }

        return $areaOfLife;
    }

    private function makeLife()
    {
        $newAreaOfLife = [];

        foreach ($this->areaOfLife as $rowIndex => $row) {

            $newRow = [];
            foreach (str_split($row) as $cellIndex => $status) {
                $cell = new Cell($this->areaOfLife, $rowIndex ,$cellIndex);
                $newRow[$cellIndex] = $cell->live();
            }

            $newAreaOfLife[$rowIndex] = join("", $newRow);
        }

        return $newAreaOfLife;
    }

    private function toString()
    {
        $string = '';
        foreach ($this->areaOfLife as $x => $row) {
            $string .= $row . PHP_EOL;
        }

        return $string;
    }
}