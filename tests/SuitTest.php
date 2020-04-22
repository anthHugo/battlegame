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
        $suit = new Suit(52);
        $cards = $suit->slice();

        static::assertIsArray($cards);
        static::assertCount(52, $cards);

        foreach ($suit->slice() as $card) {
            static::assertInstanceOf(Card::class, $card);
        }
    }

    /**
     * @dataProvider sliceProvider
     */
    public function testSliceSuitCard(int $totalCards, int $result, int $current, int $total): void
    {
        $suit = new Suit($totalCards);

        static::assertCount($result, $suit->slice($current, $total));
    }

    public function testSuitsAreDifferent(): void
    {
        $suit = new Suit(52);
        $player1 = $suit->slice(1, 2);
        $player2 = $suit->slice(2, 2);

        array_map(function(Card $card1, Card $card2) {
            static::assertNotEquals($card2->getValue(), $card1->getValue());
        }, $player1, $player2);
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