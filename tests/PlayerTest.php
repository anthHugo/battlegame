<?php

declare(strict_types=1);

namespace App\Tests;

use App\Card;
use App\Player;
use PHPUnit\Framework\TestCase;

class PlayerTest extends TestCase
{
    public function testConstructor(): void
    {
        $cards = [new Card(1), new Card(3)];
        $player = new Player('Player 1', $cards);

        static::assertSame('Player 1', $player->getName());
        static::assertSame($cards, $player->getCards());
    }

    public function testGetConstructorException(): void
    {
        static::expectException(\Exception::class);
        static::expectExceptionMessage('Card must be an instance of App\Card');

        new Player('Player 1', [1, false]);
    }

    public function testToString(): void
    {
        static::assertSame('Player 1', (string) new Player('Player 1'));
    }
}