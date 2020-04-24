<?php

declare(strict_types=1);

namespace App\Tests\Collection;

use App\Card;
use App\Collection\CardCollection;
use PHPUnit\Framework\TestCase;

class CardCollectionTest extends TestCase
{
    public function testCreateCollection(): void
    {
        $collection = new CardCollection([1, 2]);
        $collection->setOwner('123');

        foreach ($collection as $index => $item) {
            static::assertInstanceOf(Card::class, $item);
            static::assertSame($index + 1, $item->getValue());
            static::assertSame('123', $item->getIdentifier());
        }
    }

    public function testCreateCollectionWithInvalidInput(): void
    {
        $collection = new CardCollection([1, 2, 3, 4, "string", false, 12.5, new \DateTime(), null]);

        static::assertCount(4, $collection);
    }
}