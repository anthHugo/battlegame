<?php

declare(strict_types=1);

namespace App\Tests;

use App\Collection\PlayerCollection;
use App\Collection\RoundCollection;
use App\Game;
use App\Player;
use PHPUnit\Framework\TestCase;

class GameTest extends TestCase
{
    /** @dataProvider boolShuffle */
    public function testCreateGameWithShuffle(bool $shuffle): void
    {
        $game = new Game(2, 6, $shuffle);

        static::assertInstanceOf(Game::class, $game);
        static::assertInstanceOf(PlayerCollection::class, $game->getPlayers());
        static::assertInstanceOf(RoundCollection::class, $game->getRounds());
        static::assertInstanceOf(Player::class, $game->getWinner());
    }

    public function boolShuffle(): array
    {
        return [
            [true],
            [false],
        ];
    }
}
