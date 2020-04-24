<?php

declare(strict_types=1);

namespace App\Tests;

use App\Card;
use App\Suit;
use PHPUnit\Framework\TestCase;

class SuitTest extends TestCase
{
    public function testCreateSuitCard(): void
    {
        $suit = new Suit(2);
        $cards = $suit->get();

        static::assertCount(2, $cards);
        foreach ($cards as $card) {
            static::assertInstanceOf(Card::class, $card);
        }
    }

    /**
     * @dataProvider sliceProvider
     */
    public function testSliceSuitCard(int $totalCards, int $result, int $current, int $total): void
    {
        $suit = new Suit($totalCards);

        static::assertCount($result, $suit->get($current, $total));
    }

    public function testSliceLessThanOne(): void
    {
        static::assertCount(2, (new Suit(2))->get(0, 0));
        static::assertCount(2, (new Suit(2))->get(-1, -1));
    }

    public function testShuffle(): void
    {
        static::assertNotSame(range(1, 10), (new Suit(10))->shuffle()->get()->getArrayCopy());
    }

    public function testSuitsAreDifferent(): void
    {
        $suit = new Suit(8);
        $slice1 = $suit->get(1, 2);
        $slice2 = $suit->get(2, 2);

        foreach ($slice1 as $slice) {
            static::assertNotContains($slice->getValue(), $slice2->getArrayCopy());
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