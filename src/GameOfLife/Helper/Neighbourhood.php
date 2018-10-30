<?php

namespace GameOfLife\Helper;

use GameOfLife\ValueObject\NeighbourhoodValue;

class Neighbourhood
{
    function __invoke($areaOfLife, $rowIndex, $positionIndex)
    {
        $neighbourhoodOfCell = [];

        $rowsPositions = [$rowIndex - 1, $rowIndex, $rowIndex + 1];

        foreach ($rowsPositions as $rowPosition) {
            $rowCells = $this->getForRow($areaOfLife, $rowIndex, $positionIndex, $rowPosition);
            $neighbourhoodOfCell = array_merge($neighbourhoodOfCell, $rowCells);
        }

        return $neighbourhoodOfCell;
    }

    private function getForRow($areaOfLife, $rowIndex, $positionIndex, $rowPosition) : array
    {
        $neighbourhoodOfCellFromRow = [];

        if ($this->isCanGetForRow($areaOfLife, $rowIndex)) {
            array_push($neighbourhoodOfCellFromRow, $areaOfLife[$rowPosition][$positionIndex - 1] ?? '.');

            if ($this->isCanGetIndex($rowIndex, $positionIndex)) {
                array_push($neighbourhoodOfCellFromRow, $areaOfLife[$rowPosition][$positionIndex] ?? '.');
            }

            array_push($neighbourhoodOfCellFromRow, $areaOfLife[$rowPosition][$positionIndex + 1] ?? '.');
        }

        return $neighbourhoodOfCellFromRow;
    }

    private function isCanGetForRow($areaOfLife, $rowIndex)
    {
        return ($rowIndex > 0)
            || ($rowIndex < count($areaOfLife) - NeighbourhoodValue::PREVIOUS_INDEX);
    }

    private function isCanGetIndex($rowIndex, $positionIndex)
    {
        return $rowIndex !== $positionIndex;
    }

}