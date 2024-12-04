# Fraction

[![Push](https://github.com/SakiTakamachi/php-fraction/actions/workflows/push.yml/badge.svg)](https://github.com/SakiTakamachi/php-fraction/actions/workflows/push.yml)
[![codecov](https://codecov.io/gh/SakiTakamachi/php-fraction/graph/badge.svg?token=4MIM2LRPRD)](https://codecov.io/gh/SakiTakamachi/php-fraction)

## Install

```
composer require saki/fraction
```

This library requires PHP 8.4 or higher and the BCMath extension.

## Description

This is a PHP library that handles fractions using `BcMath\Number`.
The class is `final` and `readonly`, so an immutable object.

### Create a object

The constructor is:

```
// __construct(Number|int|string $numerator, Number|int|string $denominator = 1)

use Saki\Fraction;

$fraction = new Fraction(1, 2); // 1/2
$fraction = new Fraction('0.5', -1); // -1/2
$fraction = new Fraction('-3'); // -3/1
$fraction = new Fraction('-2', '-4'); // 1/2
```

You can also create objects from strings representing fractions like `"1/2"`.

```
$fraction = Saki\Fraction::createFromFractionString('1/2');
```

### Methods

The available methods are:

- `add(Fraction|Number|int|string $num): Fraction`
- `sub(Fraction|Number|int|string $num): Fraction`
- `mul(Fraction|Number|int|string $num): Fraction`
- `div(Fraction|Number|int|string $num): Fraction`
- `mod(Fraction|Number|int|string $num): Fraction`
- `divmod(Fraction|Number|int|string $num): Fraction[]`
- `pow(Number|int|string $num): Fraction`
- `compare(Fraction|Number|int|string $num): int`
- `toNumber(): Number`

Additionally, this class is `Stringable` and supports serialization.

### Convert to `BcMath\Number`

When converting a `Fraction` to `BcMath\Number`, for example, a value like `"1/10000000000"` was too small and could end up as `"0"`.
Therefore, in this case, the numerator is `1` digit and the denominator is `11` digits, so the division is executed with `BcMath\Number::scale` extended by the `10` digits of the difference.
Division of `BcMath\Number` automatically extends `BcMath\Number::scale` by up to another `10` digits from this state, so you can obtain sufficient precision.

e.g.

```
// Example of indivisible division

use Saki\Fraction;

$fraction = new Fraction(1, 30000);
var_dump($fraction->toNumber());
```

output:

```
object(BcMath\Number)#2 (2) {
  ["value"]=>
  string(16) "0.00003333333333"
  ["scale"]=>
  int(14)
}
```

### Cast to `string`

When cast to `string`, it becomes a `string` representing a fraction, such as `"-3/10"`.
