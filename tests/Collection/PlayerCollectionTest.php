<?php

declare(strict_types=1);

namespace App\Tests\Collection;

use App\Collection\CardCollection;
use App\Collection\PlayerCollection;
use App\Player;
use PHPUnit\Framework\TestCase;

class PlayerCollectionTest extends TestCase
{
    public function testCreateCollection(): void
    {
        $players = [
            new Player('john', new CardCollection([1, 2])),
            new Player('peter', new CardCollection([3, 4])),
        ];

        foreach (new PlayerCollection($players) as $index => $item) {
            static::assertInstanceOf(Player::class, $item);
            static::assertSame($players[$index], $item);
        }
    }

    public function testGetNullPlayer(): void
    {
        static::assertNull((new PlayerCollection())->getPlayer('123'));
    }

    public function testCreateCollectionWithInvalidInput(): void
    {
        static::assertCount(
            2,
            new PlayerCollection([
                new Player('john', new CardCollection([1, 2])),
                new Player('peter', new CardCollection([3, 4])),
                false,
                "string",
                12.5,
                100,
                new \DateTime()
            ])
        );
    }
}