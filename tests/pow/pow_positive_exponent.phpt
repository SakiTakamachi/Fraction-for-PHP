--TEST--
pow() - positive exponent
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
    3,
    '5',
    new Number(10),
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
     0/1 ** 3: 0/1
     0/1 ** 5: 0/1
    0/1 ** 10: 0/1
    -1/2 ** 3: -1/8
    -1/2 ** 5: -1/32
   -1/2 ** 10: 1/1024
    -3/4 ** 3: -27/64
    -3/4 ** 5: -243/1024
   -3/4 ** 10: 59049/1048576
     5/6 ** 3: 125/216
     5/6 ** 5: 3125/7776
    5/6 ** 10: 9765625/60466176
 10000/3 ** 3: 1000000000000/27
 10000/3 ** 5: 100000000000000000000/243
10000/3 ** 10: 10000000000000000000000000000000000000000/59049
