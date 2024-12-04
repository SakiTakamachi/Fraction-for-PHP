--TEST--
toString()
--FILE--
<?php
require_once __DIR__ . '/../include.inc';

use BcMath\Number;

$values = [
    [0, 100],
    [6, new Number('33')],
    ['-5', new Number('10.001')],
    ['5', new Number('-10.000')],
    ['-5.001', new Number('-10')],
    ['5.001', new Number('10.001')],
    [1, '-123.4567890123456789012345678901234567890'],
];

foreach ($values as [$numerator, $denominator]) {
    $ret = "{$numerator}/{$denominator}: ";
    $ret = str_pad($ret, 46, ' ', STR_PAD_LEFT);
    $ret .= new Saki\Fraction($numerator, $denominator) . "\n";
    echo $ret;
}
?>
--EXPECT--
                                       0/100: 0/1
                                        6/33: 2/11
                                   -5/10.001: -5000/10001
                                   5/-10.000: -1/2
                                  -5.001/-10: 5001/10000
                                5.001/10.001: 5001/10001
1/-123.4567890123456789012345678901234567890: -1000000000000000000000000000000000000/123456789012345678901234567890123456789
