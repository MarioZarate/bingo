<?php

namespace App;

class BingoNumber
{
    const MIN_NUMBER = 1;
    const MAX_NUMBER = 75;

    public function __construct()
    {
        $this->numbers = range(self::MIN_NUMBER, self::MAX_NUMBER);
        $this->selectedNumbers = [];
    }

    public function giveOne()
    {
        while (count($this->selectedNumbers) < self::MAX_NUMBER) {
            $selected = $this->numbers[array_rand($this->numbers)];
            $index = $selected - 1;
            if (!@$this->selectedNumbers[$index]) {
                $this->selectedNumbers[$index] = $selected;
                return $selected;
            }
        }
        return 0;
    }
}