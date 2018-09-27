<?php

declare(strict_types=1);

namespace GameOfLife;

use PHPUnit\Framework\TestCase;

final class GameOfLifeTest extends TestCase
{
    /**
     * @var GameOfLife
     */
    private $vendingMachine;

    public function setUp(): void
    {
        $vm = new GameOfLife();
        $this->vendingMachine = $vm;
    }

    public function testServiceReturnsNoService(): void
    {
        $this->assertEquals('working', $this->vendingMachine->test());
    }
}
