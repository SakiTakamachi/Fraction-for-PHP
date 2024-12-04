--TEST--
serialize()
--FILE--
<?php
require_once __DIR__ . '/../include.inc';

use Saki\Fraction;

$values = [
    new Fraction(0, 10),
    new Fraction(1, 2),
    new Fraction(1, -3),
    new Fraction('-1.2', '3.4'),
    new Fraction('-4', '-0.005'),
];

foreach ($values as $value) {
    echo serialize($value) . "\n";
}
?>
--EXPECT--
O:13:"Saki\Fraction":2:{s:9:"numerator";s:1:"0";s:11:"denominator";s:1:"1";}
O:13:"Saki\Fraction":2:{s:9:"numerator";s:1:"1";s:11:"denominator";s:1:"2";}
O:13:"Saki\Fraction":2:{s:9:"numerator";s:2:"-1";s:11:"denominator";s:1:"3";}
O:13:"Saki\Fraction":2:{s:9:"numerator";s:2:"-6";s:11:"denominator";s:2:"17";}
O:13:"Saki\Fraction":2:{s:9:"numerator";s:3:"800";s:11:"denominator";s:1:"1";}
