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
        static::expectOutputString("Player 0  |Player 1  |\r
1  |3  |\r
2  |4  |\r
\r
Player 1");

         (new BattleGame(2, 4, false))->output();
    }

    public function testRunShuffle(): void
    {
        static::expectOutputString("Player 0  |\r
1  |\r
\r
Player 0");

         (new BattleGame(1, 1, true))->output();
    }
}