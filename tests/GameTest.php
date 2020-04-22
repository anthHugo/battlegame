<?php

declare(strict_types=1);

namespace App\Tests;

use App\Card;
use App\Game;
use App\Player;
use PHPUnit\Framework\TestCase;

class GameTest extends TestCase
{
    public function testConstructor(): void
    {
        $player1 = new Player('Player 1', [new Card(1), new Card(3), new Card(4)]);
        $player2 = new Player('Player 1', [new Card(6), new Card(2), new Card(5)]);

        $game = new Game([$player1, $player2]);

        foreach ($game->run()->getPlayers() as $player) {
            static::assertInstanceOf(Player::class, $player);
        }
    }

    public function testGetConstructorException(): void
    {
        static::expectException(\Exception::class);
        static::expectExceptionMessage('Player must be an instance of App\Player');

        new Game([1, false]);
    }

    public function testRun(): void
    {
        $player1 = new Player('Player 1', [new Card(1), new Card(3), new Card(4)]);
        $player2 = new Player('Player 2', [new Card(6), new Card(2), new Card(5)]);

        $game = new Game([$player1, $player2]);

        $results = $game->run();
        $winner = $results->getWinner();

        static::assertSame($player2, $winner);
    }
}