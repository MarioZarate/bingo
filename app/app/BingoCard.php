<?php

namespace App;

class BingoCard {

    protected $card;

    public function __construct()
    {
        $this->card = ["B" => [], "I" => [], "N" => [], "G" => [], "O" => []];
    }

    public function getCard()
    {
        return $this->card;
    }

    public function getColumn(string $column): array
    {
        return $this->card[$column];
    }

    public function randomUniqueNumbersBetween(int $min, int $max, int $length=5): array
    {
        $numbers = range($min, $max);
        shuffle($numbers);
        return array_slice($numbers, 0, $length);
    }

    public function setNumbersInColumn(string $column, int $lowerBound, int $upperBound): bool
    {
        $this->card[$column] = $this->randomUniqueNumbersBetween($lowerBound, $upperBound);
        if ($column == "N") {
            $this->card[$column][2] = 0;
        }
        return true;
    }
}