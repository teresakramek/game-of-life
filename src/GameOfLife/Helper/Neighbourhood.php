<?php

namespace GameOfLife\Helper;

use GameOfLife\ValueObject\NeighbourhoodValue;

class Neighbourhood
{
    function __invoke($areaOfLife, $rowIndex, $positionIndex)
    {
        $this->getForRow($areaOfLife, $rowIndex, $positionIndex);
    }

    private function getForRow($areaOfLife, $rowIndex, $positionIndex)
    {

    }

    private function isCanGetForRow($areaOfLife, $rowIndex)
    {
        return ($rowIndex > 0)
            || ($rowIndex < count($areaOfLife) - NeighbourhoodValue::PREVIOUS_INDEX);
    }

    private function isCarGetIndex($areaOfLife, $rowIndex, $positionIndex)
    {
        return $rowIndex !== $positionIndex;
    }

}