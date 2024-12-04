--TEST--
unserialize()
--FILE--
<?php
require_once __DIR__ . '/../include.inc';

$values = [
    'O:13:"Saki\Fraction":2:{s:9:"numerator";s:1:"0";s:11:"denominator";s:1:"1";}',
    'O:13:"Saki\Fraction":2:{s:9:"numerator";s:1:"1";s:11:"denominator";s:1:"2";}',
    'O:13:"Saki\Fraction":2:{s:9:"numerator";s:2:"-1";s:11:"denominator";s:1:"3";}',
    'O:13:"Saki\Fraction":2:{s:9:"numerator";s:2:"-6";s:11:"denominator";s:2:"17";}',
    'O:13:"Saki\Fraction":2:{s:9:"numerator";s:3:"800";s:11:"denominator";s:1:"1";}',
];

foreach ($values as $value) {
    $fraction = unserialize($value);
    echo "{$fraction}\n";
}
?>
--EXPECT--
0/1
1/2
-1/3
-6/17
800/1
