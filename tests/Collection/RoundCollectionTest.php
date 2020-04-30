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
        $players = [
            new Player('john', CardCollection::create([1, 2])),
            new Player('peter', CardCollection::create([3, 4])),
        ];

        $collection = new RoundCollection(new PlayerCollection($players));

        foreach ($collection as $index => $item) {
            static::assertInstanceOf(Round::class, $item);
        }
    }

    public function testGetWinner(): void
    {
        $players = [
            new Player('john', CardCollection::create([1, 2])),
            new Player('peter', CardCollection::create([3, 4])),
        ];

        $collection = new RoundCollection(new PlayerCollection($players));

        static::assertSame($players[1], $collection->getWinner());
    }

    public function testEqualPlayer(): void
    {
        $players = [
            new Player('john', CardCollection::create([1, 4])),
            new Player('peter', CardCollection::create([3, 2])),
        ];

        $collection = new RoundCollection(new PlayerCollection($players));

        static::assertNull($collection->getWinner());
    }

    public function testEqualRound(): void
    {
        $players = [
            new Player('john', CardCollection::create([1])),
            new Player('peter', CardCollection::create([1])),
        ];

        $collection = new RoundCollection(new PlayerCollection($players));

        static::assertNull($collection->getWinner());
    }

    public function testEqualRoundWithThreePlayer(): void
    {
        $players = [
            new Player('john', CardCollection::create([1])),
            new Player('peter', CardCollection::create([2])),
            new Player('Ted', CardCollection::create([2])),
        ];

        $collection = new RoundCollection(new PlayerCollection($players));

        static::assertNull($collection->getWinner());
    }

    public function testGetArrayCopy(): void
    {
        $players = [
            new Player('john', CardCollection::create([1, 4])),
            new Player('peter', CardCollection::create([3, 2])),
        ];

        $collection = new RoundCollection(new PlayerCollection($players));

        foreach ($collection->getArrayCopy() as $index => $item) {
            static::assertInstanceOf(Round::class, $item);
        }
    }
}
