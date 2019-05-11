<?php

namespace GameOfLife;

use PHPUnit\Framework\TestCase;

class CellTest extends TestCase
{
     public function cellDataProvider()
     {
         return [
             'make live cell - 3 cells life' => [
                 [['x', 'x', 'x'],['.', '.', '.'],['.', '.', '.']], 1, 1, 'x', '.'
             ],
             'make stil life cell: 2' => [
                 [['x', 'x', '.'],['.', 'x', '.'],['.', '.', '.']], 1, 1, 'x', 'x'
             ],
             'make stil life cell: 3' => [
                 [['x', 'x', 'x'],['.', 'x', '.'],['.', '.', '.']], 1, 1, 'x', 'x'
             ],
             'make dead cell when only 1 live' => [
                 [['.', '.', 'x'],['.', 'x', '.'],['.', '.', '.']], 1, 1, '.', 'x'
             ],
             'make dead cell when only to many live' => [
                 [['x', 'x', 'x'],['x', 'x', '.'],['.', '.', '.']], 1, 1, '.', 'x'
             ]
         ];
     }

    /**
     * @dataProvider cellDataProvider
     * @param $area
     * @param $x
     * @param $y
     * @param $expectedStatus
     * @param $initialStatus
     * @throws \Exception
     */
     public function testReturnCellStatusFromDataToMakeDecision($area, $x, $y, $expectedStatus, $initialStatus)
     {
         $cell = new Cell($area, $x, $y);

         $this->assertEquals($initialStatus, $cell->getState());
         $this->assertCount(8, $cell->getNeighbourhoodOfCell());
         $this->assertEquals($expectedStatus, $cell->live());
     }
}
