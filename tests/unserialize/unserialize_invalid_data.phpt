--TEST--
unserialize() - invalid data
--FILE--
<?php
require_once __DIR__ . '/../include.inc';

$values = [
    'O:13:"Saki\Fraction":2:{s:9:"numerator";s:1:"0";s:11:"denominator";s:1:"1";}',
    'O:13:"Saki\Fraction":2:{s:9:"numerator";s:1:"1";s:11:"denominator";s:1:"3";}',
    'O:13:"Saki\Fraction":2:{s:9:"numerator";s:1:"6";s:11:"denominator";s:2:"17";}',
    'O:13:"Saki\Fraction":2:{s:9:"numerator";s:3:"800";s:11:"denominator";s:1:"1";}',
];

echo "invalid keys:\n";
try {
    unserialize('O:13:"Saki\Fraction":2:{s:9:"numeratox";s:1:"0";s:11:"denominator";s:1:"1";}');
} catch (Throwable $e) {
    echo $e->getMessage() . "\n";
}
try {
    unserialize('O:13:"Saki\Fraction":2:{s:9:"numerator";s:1:"0";s:11:"denominatox";s:1:"1";}');
} catch (Throwable $e) {
    echo $e->getMessage() . "\n";
}

echo "\n", "invalid values:\n";
try {
    unserialize('O:13:"Saki\Fraction":2:{s:9:"numerator";s:1:"1";s:11:"denominator";s:1:"0";}');
} catch (Throwable $e) {
    echo $e->getMessage() . "\n";
}
try {
    unserialize('O:13:"Saki\Fraction":2:{s:9:"numerator";s:3:"0.1";s:11:"denominator";s:1:"1";}');
} catch (Throwable $e) {
    echo $e->getMessage() . "\n";
}
try {
    unserialize('O:13:"Saki\Fraction":2:{s:9:"numerator";s:1:"0";s:11:"denominator";s:3:"0.1";}');
} catch (Throwable $e) {
    echo $e->getMessage() . "\n";
}
try {
    unserialize('O:13:"Saki\Fraction":2:{s:9:"numerator";s:1:"0";s:11:"denominator";s:2:"-2";}');
} catch (Throwable $e) {
    echo $e->getMessage() . "\n";
}
?>
--EXPECT--
invalid keys:
Invalid serialized data
Invalid serialized data

invalid values:
Invalid serialized data
Invalid serialized data
Invalid serialized data
Invalid serialized data
