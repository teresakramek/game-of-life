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

    public function __construct()
    {
        return $this;
    }

    public function live() : string
    {
        return self::DEAD_CELL;
    }
}