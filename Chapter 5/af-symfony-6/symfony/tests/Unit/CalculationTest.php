<?php

namespace App\Tests\Unit;

use App\Example\Calculator;

use PHPUnit\Framework\TestCase;

class CalculationTest extends TestCase

{

    public function testCanCalculateTotal()

    {

        // Expected result:

        $expectedTotal = 6;

        // Test data:

        $a = 1;

        $b = 2;

        $c = 3;

        $calculator = new Calculator();

        $total      = $calculator->calculateTotal($a, $b, 

            $c);

        $this->assertEquals($expectedTotal, $total);

    }

}
