<?php

declare(strict_types=1);

namespace GameOfLife;

use GameOfLife\Exception\DataNotFoundException;
use GameOfLife\Service\GameOfLifeResolver;
use PHPUnit\Framework\TestCase;
use GameOfLife\AreaCell;

final class GameOfLifeTest extends TestCase
{
    /** @var GameOfLife */
    private $vendingMachine;

    /** @var GameOfLifeResolver  */
    private $gameOfLifeResolver;

    private $input;

    public function setUp(): void
    {
        $this->gameOfLifeResolver = new GameOfLifeResolver();
        $this->vendingMachine = new GameOfLife($this->gameOfLifeResolver);

        $this->input = file_get_contents(__DIR__ . '/../testData/glider.txt');
    }

    public function testServiceReturnsNoService(): void
    {
        $this->assertEquals('not working', $this->vendingMachine->test());
    }

    public function testThrowDataNotFoundExceptionWhenNotAddDataToResolver()
    {
        $this->expectException(DataNotFoundException::class);
        $this->expectExceptionMessage('can not find data in resolver');

        $this->gameOfLifeResolver->createLife();
    }

    public function testReturnFalseWhenDividedInputDataAreNotEmpty()
    {
        $actual = $this->gameOfLifeResolver->setArea($this->input);

        foreach ($actual as $item) {
            $this->assertFalse(empty($item));
        }
    }

    public function testReturnDeadCellWhenAllNeighbourhoodForCellIsDead()
    {
        $areaOfLifeArray = $this->gameOfLifeResolver->setArea($this->input);

        $cell = new Cell($areaOfLifeArray, 0 ,0);

        $this->assertEquals('.', $cell->live());
    }

    public function testReturnLiveCellWhenDeadCellHasThreeLiveNeighbourhood()
    {
        $areaOfLifeArray = $this->gameOfLifeResolver->setArea($this->input);

        $cell = new Cell($areaOfLifeArray, 3 ,3);

        $this->assertEquals('x', $cell->live());
    }

    public function testReturnLiveCellWhenDeadCellHasTwoLiveCellNeighbourhood()
    {
        $areaOfLifeArray = $this->gameOfLifeResolver->setArea($this->input);

        $cell = new Cell($areaOfLifeArray, 7 ,1);

        $this->assertEquals('x', $cell->live());
    }

    public function tesReturnDeadCellWhenLiveCellHasFourLiveCellNeighbourhood()
    {
        $areaOfLifeArray = $this->gameOfLifeResolver->setArea($this->input);

        $cell = new Cell($areaOfLifeArray, 7 ,1);

        $this->assertEquals('.', $cell->live());
    }

    public function tesReturnDeadCellWhenLiveCellHasOneLiveCellNeighbourhood()
    {
        $areaOfLifeArray = $this->gameOfLifeResolver->setArea($this->input);

        $cell = new Cell($areaOfLifeArray, 2 ,4);

        $this->assertEquals('.', $cell->live());
    }

    public function testReturnEightNeighbourhoodCellsWhenAllNeighbourhoodForCellIsDeadAndRequestedIsDeadCell()
    {
        $areaOfLifeArray = $this->gameOfLifeResolver->setArea($this->input);

        $cell = new Cell($areaOfLifeArray, 2 ,4);

        $this->assertCount(8, $cell->getNeighbourhoodOfCell());
    }

    public function testReturnEightNeighbourhoodCellsWhenAllNeighbourhoodForCellIsDeadAndRequestedIsAliveCell()
    {
        $areaOfLifeArray = $this->gameOfLifeResolver->setArea($this->input);

        $cell = new Cell($areaOfLifeArray, 4 ,4);

        $this->assertCount(8, $cell->getNeighbourhoodOfCell());
    }

    public function testReturnTrueWhenIfInNeighbourhoodIsOneLiveCell()
    {
        $areaOfLifeArray = $this->gameOfLifeResolver->setArea($this->input);

        $cell = new Cell($areaOfLifeArray, 2 ,4);

        $this->assertTrue(in_array('x', $cell->getNeighbourhoodOfCell()));
    }

    public function testReturnFalseWhenIfInNeighbourhoodAnyLiveCell()
    {
        $areaOfLifeArray = $this->gameOfLifeResolver->setArea($this->input);

        $cell = new Cell($areaOfLifeArray, 0 ,0);

        $this->assertFalse(in_array('x', $cell->getNeighbourhoodOfCell()));
    }

    public function testReturnTheSameValueWhenIfInNeighbourhoodAnyLiveCell()
    {
        $areaOfLifeArray = $this->gameOfLifeResolver->setArea($this->input);

        $cell = new Cell($areaOfLifeArray, 0 ,0);

        $this->assertEquals('.', $cell->getState());
    }

}
