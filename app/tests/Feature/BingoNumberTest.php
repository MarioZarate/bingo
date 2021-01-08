<?php

namespace Tests\Feature;

use App\BingoNumber;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BingoNumberTest extends TestCase
{
    public function testGiveOneReturnOneNumber()
    {
        $bingoNumber = new BingoNumber();
        $response = $bingoNumber->giveOne();
        $this->assertTrue($response >= BingoNumber::MIN_NUMBER && $response <= BingoNumber::MAX_NUMBER);
    }

    public function testGiveOneSeventyFiveTimes()
    {
        $times = 75;
        $numbers = range(1, 75);
        $selectedNumbers = [];
        $bingoNumber = new BingoNumber();
        while ($times--) {
            $response = $bingoNumber->giveOne();
            if (!$response) {
                break;
            }
            $selectedNumbers[] = $response;
        }
        $missingNumbers = array_diff($numbers, $selectedNumbers);
        $this->assertEmpty($missingNumbers);
    }
}
