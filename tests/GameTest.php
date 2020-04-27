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

    public function testGetWinnerThrowException(): void
    {
        static::expectException(\Exception::class);
        static::expectExceptionMessage('Player not found');

        $game = new Game(2, 6, false);

        $reflection = new \ReflectionClass($game);
        $property = $reflection->getProperty('players');
        $property->setAccessible(true);
        $players = static::createMock(PlayerCollection::class);
        $players->method('getPlayer')->willReturn(null);
        $players->method('getPlayerIds')->willReturn(['id1', 'id2']);
        $property->setValue($game, $players);

        $game->getWinner();
    }

    public function boolShuffle(): array
    {
        return [
            [true],
            [false],
        ];
    }
}
