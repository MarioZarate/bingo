<?php

namespace App;

class BingoCheck {

    public function callBingo(BingoCard $card, array $calledNumbers): bool
    {
        $checks = 0;
        foreach ($calledNumbers as $calledNumber) {
            $column = $calledNumber[0];
            $number = $calledNumber[1];
            if (!in_array($number, $card->getColumn($column))) {
                return false;
            }
            $checks++;
        }
        return ($checks != 25) ? false : true;
    }
}