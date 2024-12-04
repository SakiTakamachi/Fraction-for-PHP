--TEST--
toString() - using cache
--FILE--
<?php
require_once __DIR__ . '/../include.inc';

use Saki\Fraction;

$prop = new ReflectionProperty(Fraction::class, 'stringCache');
$prop->setAccessible(true);

$fraction = new Fraction(3, 5);
$cache = $prop->getValue($fraction);

echo 'cache: ' . (is_null($cache->value) ? 'null' : $cache->value) . "\n";
echo "do __toString(): {$fraction}\n";

echo 'cache: ' . (is_null($cache->value) ? 'null' : $cache->value) . "\n";
echo "do __toString(): {$fraction}\n";
?>
--EXPECT--
cache: null
do __toString(): 3/5
cache: 3/5
do __toString(): 3/5
