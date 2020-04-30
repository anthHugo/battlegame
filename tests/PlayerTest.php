<?php

declare(strict_types=1);

namespace App\Tests;

use App\Collection\CardCollection;
use App\Player;
use PHPUnit\Framework\TestCase;

class PlayerTest extends TestCase
{
    public function testConstructor(): void
    {
        $player = new Player('Player 1', CardCollection::create([1, 3]));

        static::assertSame('Player 1', $player->getName());
        static::assertInstanceOf(CardCollection::class, $player->getCards());
    }

    public function testSetName(): void
    {
        $player = new Player('Player 1', new CardCollection());

        static::assertSame('Player 1', $player->getName());
        static::assertSame('Player 2', $player->setName('Player 2')->getName());
    }

    public function testToString(): void
    {
        static::assertSame('Player 1', (string) new Player('Player 1', CardCollection::create([])));
    }
}
