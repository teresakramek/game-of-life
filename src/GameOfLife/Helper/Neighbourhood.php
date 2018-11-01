<?php

namespace GameOfLife\Helper;

use GameOfLife\ValueObject\NeighbourhoodValue;

class Neighbourhood
{
    private $areaOfLife;
    private $rowIndex;
    private $positionIndex;

    function __invoke(array $areaOfLife, int $rowIndex, int $positionIndex)
    {
        $this->areaOfLife = $areaOfLife;
        $this->rowIndex = $rowIndex;
        $this->positionIndex = $positionIndex;

        $neighbourhoodOfCell = [];

        $rowsPositions = [$rowIndex - 1, $rowIndex, $rowIndex + 1];

        foreach ($rowsPositions as $rowPosition) {
            $rowCells = $this->getForRow($rowPosition);
            $neighbourhoodOfCell = array_merge($neighbourhoodOfCell, $rowCells);
        }

        return $neighbourhoodOfCell;
    }

    private function getForRow($rowPosition) : array
    {
        $neighbourhoodOfCellFromRow = [];

        $row = $this->areaOfLife[$rowPosition];

        if ($this->isCanGetForRow()) {
            array_push($neighbourhoodOfCellFromRow, $row[$this->positionIndex - 1] ?? '.');

            if ($this->isCanGetIndex($rowPosition)) {
                array_push($neighbourhoodOfCellFromRow, $row[$this->positionIndex] ?? '.');
            }

            array_push($neighbourhoodOfCellFromRow, $row[$this->positionIndex + 1] ?? '.');
        }

        return $neighbourhoodOfCellFromRow;
    }

    private function isCanGetForRow() : bool
    {
        return ($this->rowIndex > 0)
            || ($this->rowIndex < count($this->areaOfLife) - NeighbourhoodValue::PREVIOUS_INDEX);
    }

    private function isCanGetIndex($rowPosition) : bool
    {
        return $this->rowIndex !== $rowPosition;
    }

}