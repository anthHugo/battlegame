<?php

declare(strict_types=1);

namespace App;

class Card
{
    private int $value;

    private ?string $identifier;

    public function __construct(int $value, string $identifier = null)
    {
        $this->value = $value;
        $this->identifier = $identifier;
    }

    public function getValue(): int
    {
        return $this->value;
    }

    public function getIdentifier(): ?string
    {
        return $this->identifier;
    }

    public function __toString(): string
    {
        return (string) $this->getValue();
    }
}
