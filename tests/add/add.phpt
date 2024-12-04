--TEST--
add()
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
    0,
    '1.0',
    '3/4',
    '-7/8',
    '-3/-2',
    new Number('-1.2'),
    new Fraction(2, 3),
];

foreach ($lefts as $left) {
    foreach ($rights as $right) {
        $ret = "{$left} + {$right}: ";
        $ret = str_pad($ret, 14, ' ', STR_PAD_LEFT);
        $ret .= $left->add($right) . "\n";
        echo $ret;
    }
}
?>
--EXPECT--
     0/1 + 0: 0/1
   0/1 + 1.0: 1/1
   0/1 + 3/4: 3/4
  0/1 + -7/8: -7/8
 0/1 + -3/-2: 3/2
  0/1 + -1.2: -6/5
   0/1 + 2/3: 2/3
     1/2 + 0: 1/2
   1/2 + 1.0: 3/2
   1/2 + 3/4: 5/4
  1/2 + -7/8: -3/8
 1/2 + -3/-2: 2/1
  1/2 + -1.2: -7/10
   1/2 + 2/3: 7/6
    -1/3 + 0: -1/3
  -1/3 + 1.0: 2/3
  -1/3 + 3/4: 5/12
 -1/3 + -7/8: -29/24
-1/3 + -3/-2: 7/6
 -1/3 + -1.2: -23/15
  -1/3 + 2/3: 1/3
