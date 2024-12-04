--TEST--
toNumber() - using cache
--FILE--
<?php
require_once __DIR__ . '/../include.inc';

use Saki\Fraction;

$prop = new ReflectionProperty(Fraction::class, 'numberCache');
$prop->setAccessible(true);

$fraction = new Fraction(1, 8);
$cache = $prop->getValue($fraction);

echo 'cache: ' . (is_null($cache->value) ? 'null' : $cache->value) . "\n";
$number = $fraction->toNumber();
echo "do toNumber(): {$number}\n";
echo 'class: ' . get_class($number) . "\n";

echo 'cache: ' . (is_null($cache->value) ? 'null' : $cache->value) . "\n";
echo 'class: ' . get_class($cache->value) . "\n";

if ($cache->value === $number) {
    echo "same object\n";
}

echo "do toNumber(): {$fraction->toNumber()}\n";
echo 'class: ' . get_class($number) . "\n";
?>
--EXPECT--
cache: null
do toNumber(): 0.125
class: BcMath\Number
cache: 0.125
class: BcMath\Number
same object
do toNumber(): 0.125
class: BcMath\Number
