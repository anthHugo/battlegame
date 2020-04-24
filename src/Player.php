<?php

declare(strict_types=1);

namespace App;

use App\Collection\CardCollection;

class Player
{
    private string $id;

    private string $name;

    private CardCollection $cards;

    public function __construct(string $name, CardCollection $cards)
    {
        $this->id = uniqid();
        $this->name = $name;
        $this->cards = $cards;
        $this->cards->setOwner($this->id);
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getCards(): CardCollection
    {
        return $this->cards;
    }

    public function __toString(): string
    {
        return $this->name;
    }
}