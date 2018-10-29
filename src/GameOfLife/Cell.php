<?php
/**
 * Created by PhpStorm.
 * User: marcin
 * Date: 28.10.18
 * Time: 21:41
 */

namespace GameOfLife;


class Cell
{
    const LIVE_CELL = 'x';

    const DEAD_CELL = '.';
    /**
     * @var array
     */
    private $areaOfLife;
    /**
     * @var int
     */
    private $rowIndex;
    /**
     * @var int
     */
    private $positionIndex;

    public function __construct(array $areaOfLife, int $rowIndex, int $positionIndex)
    {
        $this->areaOfLife = $areaOfLife;
        $this->rowIndex = $rowIndex;
        $this->positionIndex = $positionIndex;
    }

    public function live() : string
    {
        return self::DEAD_CELL;
    }

    public function getNeighbourhoodOfCell()
    {

        $neighbourhoodOfCell = [];
        //previous row
        if (($this->rowIndex > 0) && ($previousRow = $this->areaOfLife[$this->rowIndex - 1])) {
            array_push($neighbourhoodOfCell, ($previousRow[$this->positionIndex - 1] ?? '.'));
            array_push($neighbourhoodOfCell, ($previousRow[$this->positionIndex] ?? '.'));
            array_push($neighbourhoodOfCell, ($previousRow[$this->positionIndex + 1] ?? '.'));
        } else {
            array_push($neighbourhoodOfCell, '.', '.', '.');
        }

        if (($currentRow = $this->areaOfLife[$this->rowIndex])) {
            array_push($neighbourhoodOfCell, ($currentRow[$this->positionIndex - 1] ?? '.'));
            array_push($neighbourhoodOfCell, ($currentRow[$this->positionIndex + 1] ?? '.'));
        }

        if (($this->rowIndex < count($this->areaOfLife) - 1) && ($nextRow = $this->areaOfLife[$this->rowIndex + 1])) {
            array_push($neighbourhoodOfCell, ($nextRow[$this->positionIndex - 1] ?? '.'));
            array_push($neighbourhoodOfCell, ($nextRow[$this->positionIndex] ?? '.'));
            array_push($neighbourhoodOfCell, ($nextRow[$this->positionIndex + 1] ?? '.'));
        } else {
            array_push($neighbourhoodOfCell, '.', '.', '.');
        }

        return $neighbourhoodOfCell;

    }
}