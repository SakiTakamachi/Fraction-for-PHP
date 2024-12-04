--TEST--
toNumber()
--FILE--
<?php
require_once __DIR__ . '/../include.inc';

use BcMath\Number;
use Saki\Fraction;

$values = [
    new Fraction(0, 1),
    new Fraction(1, 3),
    new Fraction(-2, 3),
    new Fraction(1, -30000),
    new Fraction(-10000, -3),
];

foreach ($values as $value) {
    $num = $value->toNumber();
    if ($num instanceof Number) {
        $str = "{$value}: ";
        echo str_pad($str, 10, ' ', STR_PAD_LEFT);
        echo $value->toNumber() . "\n";
    }
}
?>
--EXPECT--
     0/1: 0
     1/3: 0.3333333333
    -2/3: -0.6666666666
-1/30000: -0.00003333333333
 10000/3: 3333.3333333333
