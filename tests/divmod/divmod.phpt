--TEST--
divmod()
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
        $ret = "{$left} divmod {$right}: ";
        $ret = str_pad($ret, 18, ' ', STR_PAD_LEFT);
        [$quot, $rem] = $left->divmod($right);
        $ret .= "quot: {$quot}, ";
        $ret .= "rem: {$rem}\n";
        echo $ret;
    }
}
?>
--EXPECT--
  0/1 divmod 1.0: quot: 0/1, rem: 0/1
  0/1 divmod 1/2: quot: 0/1, rem: 0/1
 0/1 divmod -1.2: quot: 0/1, rem: 0/1
  0/1 divmod 2/3: quot: 0/1, rem: 0/1
  5/2 divmod 1.0: quot: 2/1, rem: 1/2
  5/2 divmod 1/2: quot: 5/1, rem: 0/1
 5/2 divmod -1.2: quot: -2/1, rem: 1/10
  5/2 divmod 2/3: quot: 3/1, rem: 1/2
 -8/3 divmod 1.0: quot: -2/1, rem: -2/3
 -8/3 divmod 1/2: quot: -5/1, rem: -1/6
-8/3 divmod -1.2: quot: 2/1, rem: -4/15
 -8/3 divmod 2/3: quot: -4/1, rem: 0/1
