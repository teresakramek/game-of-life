<?php

declare(strict_types=1);

namespace GameOfLife\Service;

use GameOfLife\Cell;
use GameOfLife\Exception\DataNotFoundException;

class GameOfLifeResolver
{
    const LIVE_CELL = 'x';

    const DEAD_CELL = '.';

    private $areaOfLife;

    public function createLife(): string
    {
        if (empty($this->areaOfLife)) {
            throw new \InvalidArgumentException('can not find data in resolver');
        }

        $this->areaOfLife = $this->makeLife();

        return $this->__toString();
    }

    public function setArea(string $area): self
    {
        $this->areaOfLife = $this->toArray($area);

        return $this;
    }

    private function toArray($areaOfLife): array
    {
        $areaOfLife = explode(PHP_EOL, $areaOfLife);

        foreach ($areaOfLife as $index => $row) {
            if (empty($row)) {
                 unset($areaOfLife[$index]);
            }
        }

        return $areaOfLife;
    }

    private function makeLife(): array
    {
        $newAreaOfLife = [];

        foreach ($this->areaOfLife as $rowIndex => $row) {
            $newRow = [];
            foreach (str_split($row) as $cellIndex => $status) {
                $cell = new Cell($this->areaOfLife, $rowIndex, $cellIndex);
                $newRow[$cellIndex] = $cell->live();
            }
            $newAreaOfLife[$rowIndex] = join("", $newRow);
        }

        return $newAreaOfLife;
    }

    public function __toString(): string
    {
        $result = '';
        foreach ($this->areaOfLife as $x => $row) {
            $result .= $row . PHP_EOL;
        }
        return $result;
    }
}
