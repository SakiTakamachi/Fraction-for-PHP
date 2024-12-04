--TEST--
construct() - division by zero
--FILE--
<?php
require_once __DIR__ . '/../include.inc';

try{
    $fraction = new Saki\Fraction(1, 0);
} catch (Exception $e) {
    echo $e->getMessage() . "\n";
}

try{
    $fraction = new Saki\Fraction(1, '-0');
} catch (Exception $e) {
    echo $e->getMessage() . "\n";
}

try{
    $fraction = new Saki\Fraction(1, '0.00');
} catch (Exception $e) {
    echo $e->getMessage() . "\n";
}

try{
    $fraction = new Saki\Fraction(1, '-0.00');
} catch (Exception $e) {
    echo $e->getMessage() . "\n";
}

try{
    $fraction = new Saki\Fraction(1, new BcMath\Number(0));
} catch (Exception $e) {
    echo $e->getMessage() . "\n";
}

try{
    $fraction = new Saki\Fraction(1, new BcMath\Number(('-0')));
} catch (Exception $e) {
    echo $e->getMessage() . "\n";
}
?>
--EXPECT--
The denominator is zero
The denominator is zero
The denominator is zero
The denominator is zero
The denominator is zero
The denominator is zero
