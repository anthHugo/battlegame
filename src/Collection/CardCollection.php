<?php

declare(strict_types=1);

namespace App\Collection;

use App\Card;

final class CardCollection extends \ArrayIterator implements ShuffleCardInterface
{
    private const START = 1;

    private ?string $owner = null;

    /** @param int[] $array */
    public static function create(array $array = []): self
    {
        return new static(array_map(
            fn ($value) => new Card($value),
            array_filter($array, fn ($value) => \is_int($value))
        ));
    }

    public static function range(int $total): self
    {
        return new static(array_map(
            fn ($value) => new Card($value),
            range(static::START, $total)
        ));
    }

    public function shuffle(int $range = null): self
    {
        if (\is_int($range)) {
            return static::range($range)->shuffle();
        }

        $cards = $this->getArrayCopy();
        $valid = shuffle($cards);

        return $valid ? new static($cards) : $this;
    }

    public function slice(int $current, int $total): self
    {
        if ($total <= 0) {
            $total = 1;
        }

        $length = intval($this->count() / $total);
        $offset = ($current * $length) - $length;

        return new static(array_slice($this->getArrayCopy(), $offset, $length));
    }

    public function setOwner(string $identifier): self
    {
        $this->owner = $identifier;

        return $this;
    }

    public function current(): Card
    {
        return parent::current()->setIdentifier($this->owner);
    }

    public function getMax(): ?Card
    {
        $values = array_count_values(array_map(fn (Card $card) => $card->getValue(), $this->getArrayCopy()));

        if (count($values) === 0) {
            return null;
        }

        $max = \max($this->getArrayCopy());

        if ($values[$max->getValue()] === static::START) {
            return $max;
        }

        return null;
    }
}
