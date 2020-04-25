<?php

declare(strict_types=1);

namespace App\Tests;

use App\Card;
use App\Round;
use PHPUnit\Framework\TestCase;

class RoundTest extends TestCase
{
    public function testGetWinnerId(): void
    {
        $round = new Round([new Card(2, "P1"), new Card(4, "P2")]);

        static::assertSame("P2", $round->getWinnerId());
    }

    public function testGetCards(): void
    {
        $round = new Round([new Card(2, "P1"), new Card(4, "P2")]);

        static::assertSame(["P1" => 2, "P2" => 4], $round->getCards());
    }
}
