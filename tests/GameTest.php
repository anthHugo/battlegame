<?php

declare(strict_types=1);

namespace App\Tests;

use App\Collection\PlayerCollection;
use App\Collection\RoundCollection;
use App\Game;
use PHPUnit\Framework\TestCase;

class GameTest extends TestCase
{
    public function testConstructor(): void
    {
        $players = static::createMock(PlayerCollection::class);
        $game = new Game($players);

        static::assertInstanceOf(PlayerCollection::class, $game->getPlayers());
        static::assertSame($players, $game->getPlayers());
        static::assertInstanceOf(RoundCollection::class, $game->run());
    }
}
