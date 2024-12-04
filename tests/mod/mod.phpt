--TEST--
mod()
--FILE--
<?php
require_once __DIR__ . '/../include.inc';

use BcMath\Number;
use Saki\Fraction;

$lefts = [
    new Fraction(0, 1),
    new Fraction(5, 2),
    new Fraction(-8, 3),
];

$rights = [
    '1.0',
    '1/2',
    new Number('-1.2'),
    new Fraction(2, 3),
];

foreach ($lefts as $left) {
    foreach ($rights as $right) {
        $ret = "{$left} % {$right}: ";
        $ret = str_pad($ret, 13, ' ', STR_PAD_LEFT);
        $ret .= $left->mod($right) . "\n";
        echo $ret;
    }
}
?>
--EXPECT--
  0/1 % 1.0: 0/1
  0/1 % 1/2: 0/1
 0/1 % -1.2: 0/1
  0/1 % 2/3: 0/1
  5/2 % 1.0: 1/2
  5/2 % 1/2: 0/1
 5/2 % -1.2: 1/10
  5/2 % 2/3: 1/2
 -8/3 % 1.0: -2/3
 -8/3 % 1/2: -1/6
-8/3 % -1.2: -4/15
 -8/3 % 2/3: 0/1
