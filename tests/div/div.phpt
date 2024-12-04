--TEST--
div()
--FILE--
<?php
require_once __DIR__ . '/../include.inc';

use BcMath\Number;
use Saki\Fraction;

$lefts = [
    new Fraction(0, 1),
    new Fraction(1, 2),
    new Fraction(-1, 3),
];

$rights = [
    '1.0',
    '1/2',
    new Number('-1.2'),
    new Fraction(2, 3),
];

foreach ($lefts as $left) {
    foreach ($rights as $right) {
        $ret = "{$left} / {$right}: ";
        $ret = str_pad($ret, 13, ' ', STR_PAD_LEFT);
        $ret .= $left->div($right) . "\n";
        echo $ret;
    }
}
?>
--EXPECT--
  0/1 / 1.0: 0/1
  0/1 / 1/2: 0/1
 0/1 / -1.2: 0/1
  0/1 / 2/3: 0/1
  1/2 / 1.0: 1/2
  1/2 / 1/2: 1/1
 1/2 / -1.2: -5/12
  1/2 / 2/3: 3/4
 -1/3 / 1.0: -1/3
 -1/3 / 1/2: -2/3
-1/3 / -1.2: 5/18
 -1/3 / 2/3: -1/2
