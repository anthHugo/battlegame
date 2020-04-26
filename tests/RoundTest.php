<?php

declare(strict_types=1);

namespace App\Tests;

use App\Card;
use App\Collection\CardCollection;
use App\Round;
use PHPUnit\Framework\TestCase;

class RoundTest extends TestCase
{
    public function testGetWinnerId(): void
    {
        $round = new Round(new CardCollection([
            new Card(2, "P1"),
            new Card(4, "P2")
        ]));

        static::assertSame("P2", $round->getWinnerId());
    }

    public function testGetCards(): void
    {
        $cards = new CardCollection([
            new Card(2, "P1"),
            new Card(4, "P2")
        ]);
        $round = new Round($cards);

        static::assertSame($cards, $round->getCards());
    }
}
