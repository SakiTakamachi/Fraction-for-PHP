--TEST--
createFromFractionString() - invalid format
--FILE--
<?php
require_once __DIR__ . '/../include.inc';

use Saki\Fraction;

$strings = [
    '2/1/2',
    '',
    '2',
];

foreach ($strings as $value) {
    try {
        Fraction::createFromFractionString($value);
    } catch(Exception $e) {
        echo $e->getMessage() . "\n";
    }
}
?>
--EXPECT--
Invalid fraction format
Invalid fraction format
Invalid fraction format
