<?php

declare(strict_types=1);

namespace App\Tests;

use App\Card;
use PHPUnit\Framework\TestCase;

class CardTest extends TestCase
{
    public function testGetValue(): void
    {
        static::assertSame(1, (new Card(1))->getValue());
    }

    public function testToString(): void
    {
        static::assertSame('1', (string) (new Card(1)));
    }
}
