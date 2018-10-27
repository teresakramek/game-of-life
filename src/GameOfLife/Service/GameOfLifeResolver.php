<?php

declare(strict_types=1);

namespace GameOfLife\Service;

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

        return $this->areaOfLife;
    }

    public function setInput(string $input) : self
    {
        $this->areaOfLife = $input;

        return $this;
    }

    public function divideInputData() : array
    {
        $this->areaOfLife = explode(PHP_EOL, $this->areaOfLife);

        foreach ($this->areaOfLife as $index => $row) {
            if (empty($row)) {
                 unset($this->areaOfLife[$index]);
            }
        }
        return $this->areaOfLife;
    }

    public function getNeighbourhoodForAnyCell(int $rowIndex, int $cellIndex) : array
    {
        $row = $this->areaOfLife[$rowIndex];
    }
}