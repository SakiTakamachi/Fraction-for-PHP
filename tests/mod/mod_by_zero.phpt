--TEST--
mod() - modulo by zero
--FILE--
<?php
require_once __DIR__ . '/../include.inc';

$fraction = new Saki\Fraction(1, 5);

$values = [
    0,
    '-0.00',
    new BcMath\Number('0.00'),
    '0/1',
    '-0/100',
    '0/-100',
    '-0/-100',
    new Saki\Fraction(0, 10),
];
foreach ($values as $value) {
    try{
        $fraction->mod($value);
    } catch (Exception $e) {
        echo $e->getMessage() . "\n";
    }
}
?>
--EXPECT--
Modulo by zero
Modulo by zero
Modulo by zero
Modulo by zero
Modulo by zero
Modulo by zero
Modulo by zero
Modulo by zero
