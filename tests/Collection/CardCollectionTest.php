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
        $collection = CardCollection::create([1, 2]);
        $collection->setOwner('123');

        foreach ($collection as $index => $item) {
            static::assertInstanceOf(Card::class, $item);
            static::assertSame($index + 1, $item->getValue());
            static::assertSame('123', $item->getIdentifier());
        }
    }

    public function testCreateCollectionWithInvalidInput(): void
    {
        $collection = CardCollection::create([1, 2, 3, 4, "string", false, 12.5, new \DateTime(), null]);

        static::assertCount(4, $collection);
    }

    /**
     * @dataProvider sliceProvider
     */
    public function testSliceSuitCard(int $totalCards, int $result, int $current, int $total): void
    {
        static::assertCount($result, CardCollection::create(range(1, $totalCards))->slice($current, $total));
    }

    public function testSliceLessThanOne(): void
    {
        static::assertCount(2, CardCollection::create([1, 2])->slice(0, 0));
        static::assertCount(2, CardCollection::create([1, 2])->slice(1, -1));
    }

    public function testShuffle(): void
    {
        static::assertNotSame(
            range(1, 10),
            CardCollection::create(range(1, 10))
                ->shuffle()
                ->getArrayCopy()
        );
    }

    public function testSuitsAreDifferent(): void
    {
        $suit = CardCollection::create(range(1, 8));
        $slice1 = $suit->slice(1, 2);
        $slice2 = $suit->slice(2, 2);

        foreach ($slice1 as $index => $slice) {
            static::assertNotContains($slice, $slice2->getArrayCopy());
        }
    }

    public function sliceProvider(): array
    {
        return [
            [52, 52, 1, 1],
            [52, 26, 1, 2],
            [52, 26, 2, 2],
            [52, 26, 2, 2],
            [48, 16, 1, 3],
        ];
    }
}
