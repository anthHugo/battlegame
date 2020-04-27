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
            new Player('john', CardCollection::create([1, 2])),
            new Player('peter', CardCollection::create([3, 4])),
        ]);

        $collection = new RoundCollection($players);

        foreach ($collection as $index => $item) {
            static::assertInstanceOf(Round::class, $item);
        }
    }
}
