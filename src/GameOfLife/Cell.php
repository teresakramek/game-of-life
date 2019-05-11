<?php

namespace GameOfLife;

use GameOfLife\Helper\Neighbourhood;

/**
 * Martwa komórka, która ma dokładnie 3 żywych sąsiadów, staje się żywa w następnej jednostce czasu (rodzi się)
 * Żywa komórka z 2 albo 3 żywymi sąsiadami pozostaje nadal żywa;
 * przy innej liczbie sąsiadów umiera (z „samotności” albo „zatłoczenia”)
 */
class Cell
{
    const LIVE_CELL = 'x';

    const DEAD_CELL = '.';
    /** @var array */
    private $areaOfLife;
    /** @var int */
    private $rowIndex;
    /** @var int */
    private $positionIndex;
    /** @var string LIVE_CELL | DEAD_CELL */
    private $state;

    public function __construct(array $areaOfLife, int $rowIndex, int $positionIndex)
    {
        $this->areaOfLife = $areaOfLife;
        $this->rowIndex = $rowIndex;
        $this->positionIndex = $positionIndex;
        $this->state = $areaOfLife[$this->rowIndex][$this->positionIndex];
    }

    public function live() : string
    {
        $countNeighbourhoodCells = array_count_values($this->getNeighbourhoodOfCell());

        switch ($this->state) {
            case Cell::DEAD_CELL:
                $this->makeDecisionForDeadCell($countNeighbourhoodCells);
                break;
            case Cell::LIVE_CELL:
                $this->makeDecisionForLiveCell($countNeighbourhoodCells);
                break;
            default:
                throw new \Exception('Wrong cell state');
                break;
        }

        return $this->state;
    }

    public function getNeighbourhoodOfCell() : array
    {
        $neighbourhoodOfCell = new Neighbourhood($this->areaOfLife, $this->rowIndex, $this->positionIndex);

        return $neighbourhoodOfCell->getNeighbourhoodOfCell();
    }

    /**
     * @return string
     */
    public function getState(): string
    {
        return $this->state;
    }

    private function makeDecisionForDeadCell(array $countNeighbourhoodCells): void
    {
        if (isset($countNeighbourhoodCells[Cell::LIVE_CELL]) && $countNeighbourhoodCells[Cell::LIVE_CELL] === 3) {
            $this->state = Cell::LIVE_CELL;
        }
    }

    private function makeDecisionForLiveCell(array $countNeighbourhoodCells): void
    {
        if (isset($countNeighbourhoodCells[Cell::LIVE_CELL])
            && ($countNeighbourhoodCells[Cell::LIVE_CELL] < 2
                || $countNeighbourhoodCells[Cell::LIVE_CELL] > 3)) {
            $this->state = Cell::DEAD_CELL;
        }
    }
}
