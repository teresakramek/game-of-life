<?php

namespace GameOfLife\Helper;

use GameOfLife\ValueObject\NeighbourhoodValue;

class Neighbourhood
{
    private $areaOfLife;
    private $rowIndex;
    private $positionIndex;
    private $neighbourhoodOfCell = [];
    private $rowsPositions;

    public function __construct(array $areaOfLife, int $rowIndex, int $positionIndex)
    {
        $this->areaOfLife = $areaOfLife;
        $this->rowIndex = $rowIndex;
        $this->positionIndex = $positionIndex;
        $this->rowsPositions = [$this->rowIndex - 1, $this->rowIndex, $this->rowIndex + 1];
    }

    public function getNeighbourhoodOfCell() : array
    {
        foreach ($this->rowsPositions as $rowPosition) {
            if ($this->isCanGetForRow($rowPosition)) {
                $this->neighbourhoodOfCell = array_merge($this->neighbourhoodOfCell, $this->getNeighbourhoodOfCellFromRow($rowPosition));
            }
        }
        return $this->neighbourhoodOfCell;
    }

    private function getNeighbourhoodOfCellFromRow(int $rowIndex) : array
    {
        $neighbourhoodOfCellFromRow = [];

        $row = $this->areaOfLife[$rowIndex];

        array_push($neighbourhoodOfCellFromRow, $row[$this->positionIndex - 1] ?? '.');

        if ($this->isCanGetIndex($rowIndex)) {
            array_push($neighbourhoodOfCellFromRow, $row[$this->positionIndex] ?? '.');
        }

        array_push($neighbourhoodOfCellFromRow, $row[$this->positionIndex + 1] ?? '.');

        return $neighbourhoodOfCellFromRow;
    }

    private function isCanGetForRow(int $rowIndex) : bool
    {
        return ($rowIndex >= 0) && ($rowIndex < count($this->areaOfLife));
    }

    private function isCanGetIndex(int $rowPosition) : bool
    {
        return $this->rowIndex !== $rowPosition;
    }
}
