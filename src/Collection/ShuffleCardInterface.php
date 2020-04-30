<?php

declare(strict_types=1);

namespace App\Collection;

interface ShuffleCardInterface
{
    public function shuffle(int $range = null): CardCollection;
}
