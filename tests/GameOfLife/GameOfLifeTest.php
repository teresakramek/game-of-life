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

    public function testThrowDataNotFoundExceptionWhenNotAddDataToResolver()
    {
        $this->expectException(DataNotFoundException::class);
        $this->expectExceptionMessage('can not find data in resolver');

        $this->gameOfLifeResolver->createLife();
    }

    public function testReturnNewAreaOfLifeInSecondStep()
    {
        $initialArea = $this->input;

        $secondStepArea = $this->gameOfLifeResolver->setArea($initialArea)->createLife();

        $this->assertEquals(strlen($initialArea), strlen($secondStepArea));
        $this->assertNotEquals($initialArea, $secondStepArea);
    }

    public function testReturnNewAreaOfLifeInAllStepsOnData()
    {
        $this->gameOfLifeResolver->setArea($this->input);

        $stepArea = $this->input;

        for ($i = 0; $i < 26; $i++) {
            $nextStepArea = $this->gameOfLifeResolver->createLife();
            $this->assertEquals(strlen($stepArea), strlen($nextStepArea));
            $this->assertNotEquals($stepArea, $nextStepArea);
            $stepArea = $nextStepArea;
        }
    }

}
