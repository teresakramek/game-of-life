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

    public function testReturnLoadedAreaOfLife()
    {
        $actual = $this->gameOfLifeResolver->setInput($this->input)->createLife();

        $this->assertSame($this->input, $actual);
    }

    public function testReturnTrueWhenRLoadedInputDataIsTransformToArray()
    {
        $actual = $this->gameOfLifeResolver->setInput($this->input)->divideInputData();

        $this->assertTrue(is_array($actual));
    }

    public function testReturnFalseWhenDividedInputDataAreNotEmpty()
    {
        $actual = $this->gameOfLifeResolver->setInput($this->input)->divideInputData();

        foreach ($actual as $item) {
            $this->assertFalse(empty($item));
        }
    }

    public function testReturnDeadCellWhenAllNeighbourhoodForCellIsDead()
    {
        $areaOfLifeArray = $this->gameOfLifeResolver->setInput($this->input)->divideInputData();

        $cell = new Cell($areaOfLifeArray, 0 ,0);

        $this->assertSame('.', $cell->live());
    }

    public function testReturnEightNeighbourhoodCellsWhenAllNeighbourhoodForCellIsDeadAndRequestedIsDeadCell()
    {
        $areaOfLifeArray = $this->gameOfLifeResolver->setInput($this->input)->divideInputData();

        $cell = new Cell($areaOfLifeArray, 0 ,0);

        $this->assertCount(6, $cell->getNeighbourhoodOfCell());
    }

    public function testReturnEightNeighbourhoodCellsWhenAllNeighbourhoodForCellIsDeadAndRequestedIsAliveCell()
    {
        $areaOfLifeArray = $this->gameOfLifeResolver->setInput($this->input)->divideInputData();

        $cell = new Cell($areaOfLifeArray, 4 ,4);

        $this->assertCount(6, $cell->getNeighbourhoodOfCell());
    }




}
