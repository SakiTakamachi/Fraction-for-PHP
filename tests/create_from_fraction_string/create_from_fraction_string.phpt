--TEST--
createFromFractionString()
--FILE--
<?php
require_once __DIR__ . '/../include.inc';

use Saki\Fraction;
use Saki\Fraction\Sign;

$strings = [
    '0/100',
    '1/2',
    '6/9',
    '-8/4',
    '25/-5',
    '-2/-3',
];

foreach ($strings as $value) {
    $fraction = Fraction::createFromFractionString($value);
    $str = "{$value}: ";
    $str = str_pad($str, 7, ' ', STR_PAD_LEFT);
    if (substr($fraction->numerator, 0, 1) !== '-') {
    $str .= '+';
    }
    $str .= $fraction->numerator . '/';
    $str .= $fraction->denominator . "\n";
    echo $str;
}
?>
--EXPECT--
0/100: +0/1
  1/2: +1/2
  6/9: +2/3
 -8/4: -2/1
25/-5: -5/1
-2/-3: +2/3
