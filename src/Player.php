<?php

declare(strict_types=1);

namespace App;

class Player
{
    private string $id;

    private string $name;

    /**
     * @var Card[]
     */
    private array $cards;

    public function __construct(string $name, array $cards = [])
    {
        foreach ($cards as $card) {
            if (false === $card instanceof Card) {
                throw new \Exception('Card must be an instance of App\Card');
            }
        }

        $this->id = uniqid();
        $this->name = $name;
        $this->cards = $cards;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return Card[]
     */
    public function getCards(): array
    {
        return $this->cards;
    }

    public function __toString(): string
    {
        return $this->name;
    }
}