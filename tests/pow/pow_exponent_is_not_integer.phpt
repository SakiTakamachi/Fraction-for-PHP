--TEST--
pow() - exponent is not integer
--FILE--
<?php
require_once __DIR__ . '/../include.inc';

use BcMath\Number;
use Saki\Fraction;

$bases = [
    new Fraction(-1, 2),
    new Fraction(3, -4),
    new Fraction(-5, -6),
    new Fraction('10000', 3),
];

$exponents = [
    '5.0',
    '-5.1',
    new Number('-10.0'),
    new Number('10.1'),
];

foreach ($bases as $base) {
    foreach ($exponents as $exponent) {
        try {
            $base->pow($exponent);
        } catch (Exception $e) {
            echo $e->getMessage() . "\n";
        }
    }
}
?>
--EXPECT--
The exponent must be an integer
The exponent must be an integer
The exponent must be an integer
The exponent must be an integer
The exponent must be an integer
The exponent must be an integer
The exponent must be an integer
The exponent must be an integer
The exponent must be an integer
The exponent must be an integer
The exponent must be an integer
The exponent must be an integer
The exponent must be an integer
The exponent must be an integer
The exponent must be an integer
The exponent must be an integer
