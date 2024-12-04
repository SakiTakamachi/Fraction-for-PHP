--TEST--
pow() - zero exponent
--FILE--
<?php
require_once __DIR__ . '/../include.inc';

use BcMath\Number;
use Saki\Fraction;

$bases = [
    new Fraction(0, 1),
    new Fraction(-1, 2),
    new Fraction(3, -4),
    new Fraction(-5, -6),
    new Fraction('10000', 3),
];

$exponents = [
    0,
    '-0',
    new Number(0),
];

foreach ($bases as $base) {
    foreach ($exponents as $exponent) {
        $ret = "{$base} ** {$exponent}: ";
        $ret = str_pad($ret, 15, ' ', STR_PAD_LEFT);
        $ret .= $base->pow($exponent) . "\n";
        echo $ret;
    }
}
?>
--EXPECT--
     0/1 ** 0: 1/1
    0/1 ** -0: 1/1
     0/1 ** 0: 1/1
    -1/2 ** 0: 1/1
   -1/2 ** -0: 1/1
    -1/2 ** 0: 1/1
    -3/4 ** 0: 1/1
   -3/4 ** -0: 1/1
    -3/4 ** 0: 1/1
     5/6 ** 0: 1/1
    5/6 ** -0: 1/1
     5/6 ** 0: 1/1
 10000/3 ** 0: 1/1
10000/3 ** -0: 1/1
 10000/3 ** 0: 1/1
