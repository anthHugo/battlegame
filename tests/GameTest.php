<?php

declare(strict_types=1);

namespace App\Tests;

use App\Card;
use App\Game;
use App\Player;
use PHPUnit\Framework\TestCase;

class GameTest extends TestCase
{
    public function testAddPlayer(): void
    {
        $player1 = new Player('Player 1', [new Card(1), new Card(3), new Card(4)]);
        $player2 = new Player('Player 2', [new Card(6), new Card(2), new Card(5)]);

        $game = new Game();
        $game->addPlayer($player1);
        $game->addPlayer($player2);

        foreach ($game->getPlayers() as $player) {
            static::assertInstanceOf(Player::class, $player);
        }
    }

    public function testRun(): void
    {
        $player1 = new Player('Player 1', [new Card(1), new Card(3), new Card(4)]);
        $player2 = new Player('Player 2', [new Card(6), new Card(2), new Card(5)]);

        $game = new Game();
        $game->addPlayer($player1);
        $game->addPlayer($player2);

        static::assertSame($player2, $game->getWinner());
    }
}