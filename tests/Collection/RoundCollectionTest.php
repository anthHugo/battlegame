<?php

declare(strict_types=1);

namespace App\Tests\Collection;

use App\Collection\CardCollection;
use App\Collection\PlayerCollection;
use App\Collection\RoundCollection;
use App\Player;
use App\Round;
use PHPUnit\Framework\TestCase;

class RoundCollectionTest extends TestCase
{
    public function testCreateCollection(): void
    {
        $players = new PlayerCollection([
            new Player('john', new CardCollection([1, 2])),
            new Player('peter', new CardCollection([3, 4])),
        ]);

        $collection = (new RoundCollection())->addPlayers($players);

        foreach ($collection as $index => $item) {
            static::assertInstanceOf(Round::class, current($item));
            static::assertSame($players[1]->getId(), current($item)->getWinnerId());
        }

        static::assertSame($players[1], $collection->getWinner());
    }

    public function testThrowException(): void
    {
        static::expectException(\Exception::class);

        $players = static::createMock(PlayerCollection::class);
        $players->method('getPlayerIds')->willReturn(["id", "tmp"]);
        $players->method('getPlayer')->willReturn(null);

        $collection = (new RoundCollection())->addPlayers($players);
        $collection->getWinner();
    }
}
