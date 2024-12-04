--TEST--
pow() - negative power of zero
--FILE--
<?php
require_once __DIR__ . '/../include.inc';

use BcMath\Number;
use Saki\Fraction;

$base = new Fraction(0, 1);

$exponents = [
    -3,
    '-1',
    new Number(-600000000),
];

foreach ($exponents as $exponent) {
    try {
        $base->pow($exponent);
    } catch (Exception $e) {
        echo $e->getMessage() . "\n";
    }
}
?>
--EXPECT--
Negative power of zero
Negative power of zero
Negative power of zero
