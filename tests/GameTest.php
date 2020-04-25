<?php

declare(strict_types=1);

namespace App\Tests;

use App\Card;
use App\Collection\CardCollection;
use App\Game;
use App\Player;
use PHPUnit\Framework\TestCase;

class GameTest extends TestCase
{
    public function testCreateGame(): void
    {
        static::assertInstanceOf(Game::class, Game::create(1, 2, true));
    }

    public function testAddPlayer(): void
    {
        $game = new Game();
        $game->addPlayer(new Player('Player 1', new CardCollection([1, 3, 4])));
        $game->addPlayer(new Player('Player 2', new CardCollection([6, 2, 5])));

        foreach ($game->getPlayers() as $player) {
            static::assertInstanceOf(Player::class, $player);
        }
    }

    public function testGetWinner(): void
    {
        $player1 = new Player('Player 1', new CardCollection([1, 3, 4]));
        $player2 = new Player('Player 2', new CardCollection([6, 2, 5]));

        $game = new Game();
        $game->addPlayer($player1);
        $game->addPlayer($player2);

        static::assertSame($player2, $game->getWinner());
    }
}
