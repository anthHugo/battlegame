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
        $round = new Round([1 => new Card(2), 3 => new Card(4)]);

        static::assertSame("3", $round->getWinnerId());
    }

    public function testGetCards(): void
    {
        $round = new Round([1 => new Card(2), 3 => new Card(4)]);

        static::assertSame([1 => 2, 3 => 4], $round->getCards());
    }
}