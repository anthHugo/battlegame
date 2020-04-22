<?php

declare(strict_types=1);

namespace App\Tests;

use App\Card;
use App\GameResults;
use App\Player;
use App\Round;
use PHPUnit\Framework\TestCase;

class GameResultsTest extends TestCase
{
    public function testGetter(): void
    {
        $players = [new Player('Player 1'), new Player('Player 2')];
        $rounds = [
            new Round([new Card(1), new Card(2)]),
            new Round([new Card(3), new Card(4)]),
        ];

        $results = new GameResults($players, $rounds);

        static::assertSame($players, $results->getPlayers());
        static::assertSame($rounds, $results->getRounds());
        static::assertSame($players[1], $results->getWinner());
    }
}