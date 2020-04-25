<?php

declare(strict_types=1);

namespace App\Collection;

use App\Card;

final class CardCollection extends \ArrayIterator
{
    private ?string $owner = null;

    public static function create(array $array = []): self
    {
        return new static(array_map(
            fn ($value) => new Card($value),
            array_filter($array, fn ($value) => \is_int($value))
        ));
    }

    public function shuffle(): self
    {
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

    public function key(): string
    {
        return (string) parent::key();
    }
}
