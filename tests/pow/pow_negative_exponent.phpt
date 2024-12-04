--TEST--
pow() - negative exponent
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
    -3,
    '-5',
    new Number(-10),
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
   -1/2 ** -3: -8/1
   -1/2 ** -5: -32/1
  -1/2 ** -10: 1024/1
   -3/4 ** -3: -64/27
   -3/4 ** -5: -1024/243
  -3/4 ** -10: 1048576/59049
    5/6 ** -3: 216/125
    5/6 ** -5: 7776/3125
   5/6 ** -10: 60466176/9765625
10000/3 ** -3: 27/1000000000000
10000/3 ** -5: 243/100000000000000000000
10000/3 ** -10: 59049/10000000000000000000000000000000000000000
