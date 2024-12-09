--TEST--
construct() - denominator omitted
--FILE--
<?php
require_once __DIR__ . '/../include.inc';

use BcMath\Number;
use Saki\Fraction;
use Saki\Fraction\Sign;

$values = [
    0,
    5,
    -3,
    '100',
    '2.5',
    '-0.2',
    new Number(3),
    new Number('-0.4'),
];

foreach ($values as $value) {
    $fraction = new Fraction($value);
    $str = "{$value}: ";
    $str = str_pad($str, 6, ' ', STR_PAD_LEFT);
    if (substr($fraction->numerator, 0, 1) !== '-') {
        $str .= '+';
    }
    $str .= $fraction->numerator . '/';
    $str .= $fraction->denominator . "\n";
    echo $str;
}
?>
--EXPECT--
   0: +0/1
   5: +5/1
  -3: -3/1
 100: +100/1
 2.5: +5/2
-0.2: -1/5
   3: +3/1
-0.4: -2/5
