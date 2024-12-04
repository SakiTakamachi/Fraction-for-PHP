--TEST--
construct()
--FILE--
<?php
require_once __DIR__ . '/../include.inc';

use BcMath\Number;
use Saki\Fraction;
use Saki\Fraction\Sign;

$numerators = [
    0,
    -6,
    11,
    '22',
    new Number('-33.3'),
];
$denominators = $numerators;
unset($denominators[0]); // rm 0

foreach ($numerators as $numerator) {
    foreach ($denominators as $denominator) {
        $fraction = new Fraction($numerator, $denominator);
        $str = "{$numerator}, {$denominator}: ";
        $str = str_pad($str, 14, ' ', STR_PAD_LEFT);
        $str .= $fraction->sign === Sign::Minus ? '-' : '+';
        $str .= $fraction->numerator . '/';
        $str .= $fraction->denominator . "\n";
        echo $str;
    }
}
?>
--EXPECT--
       0, -6: +0/1
       0, 11: +0/1
       0, 22: +0/1
    0, -33.3: +0/1
      -6, -6: +1/1
      -6, 11: -6/11
      -6, 22: -3/11
   -6, -33.3: +20/111
      11, -6: -11/6
      11, 11: +1/1
      11, 22: +1/2
   11, -33.3: -110/333
      22, -6: -11/3
      22, 11: +2/1
      22, 22: +1/1
   22, -33.3: -220/333
   -33.3, -6: +111/20
   -33.3, 11: -333/110
   -33.3, 22: -333/220
-33.3, -33.3: +1/1
