<?php
/**
 * Created by PhpStorm.
 * User: marcin
 * Date: 28.10.18
 * Time: 21:41
 */

namespace GameOfLife;

use GameOfLife\Helper\Neighbourhood;

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

        $neighbourhoodOfCell = new Neighbourhood();

        $neighbourhoodOfCell = $neighbourhoodOfCell($this->areaOfLife, $this->rowIndex, $this->positionIndex);

        return $neighbourhoodOfCell;

    }
}