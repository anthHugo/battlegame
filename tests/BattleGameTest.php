<?php

declare(strict_types=1);

namespace App\Tests;

use App\BattleGame;
use App\GameResults;
use PHPUnit\Framework\TestCase;

class BattleGameTest extends TestCase
{
    public function testRun(): void
    {
        static::expectOutputString(
"===========================\r
        BattleGame\r
===========================\r
---------------------------\r
|  Player 1  |  Player 2  |\r
---------------------------\r
|         1  |         3  |\r
|         2  |         4  |\r
---------------------------\r
\r
Winner is : Player 2\r
\r\n");

         (new BattleGame(2, 4, false))->output();
    }

    public function testRunShuffle(): void
    {
        static::expectOutputString(
"==============\r
  BattleGame\r
==============\r
--------------\r
|  Player 1  |\r
--------------\r
|         1  |\r
--------------\r
\r
Winner is : Player 1\r
\r\n");

         (new BattleGame(1, 1, true))->output();
    }
}