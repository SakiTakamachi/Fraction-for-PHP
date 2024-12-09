<?php

namespace Saki;

use BcMath\Number;
use InvalidArgumentException;
use Saki\Fraction\Cache\NumberCache;
use Saki\Fraction\Cache\StringCache;
use Saki\Fraction\Sign;
use Stringable;

final readonly class Fraction implements Stringable
{
    public Sign $sign;
    public Number $numerator;
    public Number $denominator;
    private NumberCache $numberCache;
    private StringCache $stringCache;

    public function __construct(
        Number|int|string $numerator,
        Number|int|string $denominator = 1,
    ) {
        if (!$numerator instanceof Number) {
            $numerator = new Number($numerator);
        }

        if (!$denominator instanceof Number) {
            $denominator = new Number($denominator);
        }

        if ($denominator == 0) {
            throw new InvalidArgumentException('The denominator is zero');
        }

        $this->numberCache = new NumberCache();
        $this->stringCache = new StringCache();

        if ($numerator == 0) {
            $this->sign = Sign::Plus;
            $this->numerator = new Number(0);
            $this->denominator = new Number(1);
            return;
        }

        if ($numerator >= 0) {
            $numeratorSign = Sign::Plus;
        } else {
            $numeratorSign = Sign::Minus;
            $numerator = -$numerator;
        }

        if ($denominator >= 0) {
            $denominatorSign = Sign::Plus;
        } else {
            $denominatorSign = Sign::Minus;
            $denominator = -$denominator;
        }

        if ($numerator->scale !== 0 || $denominator->scale !== 0) {
            $exponent = $numerator->scale > $denominator->scale ? $numerator->scale : $denominator->scale;
            $multiplier = (new Number(10))->pow($exponent);
            $numerator = $numerator->mul($multiplier, 0);
            $denominator = $denominator->mul($multiplier, 0);
        }

        $commonDivisor = $this->getGcd($numerator, $denominator);

        $this->sign = $numeratorSign == $denominatorSign ? Sign::Plus : Sign::Minus;
        $this->numerator = $numerator->div($commonDivisor);
        $this->denominator = $denominator->div($commonDivisor);
    }

    public static function createFromFractionString(string $fraction): Fraction
    {
        $parts = explode('/', $fraction);
        if (count($parts) !== 2) {
            throw new InvalidArgumentException('Invalid fraction format');
        }

        return new Fraction($parts[0], $parts[1]);
    }
    
    private static function createFractionFromMixed(Number|int|string $num): Fraction
    {
        if (is_string($num) && str_contains($num, '/')) {
            return self::createFromFractionString($num);
        }
        return new Fraction($num);
    }

    public function add(Fraction|Number|int|string $num): Fraction
    {
        return $this->doAddSub($num, true);
    }

    public function sub(Fraction|Number|int|string $num): Fraction
    {
        return $this->doAddSub($num, false);
    }

    private function doAddSub(Fraction|Number|int|string $num, bool $isAdd): Fraction
    {
        if (!$num instanceof Fraction) {
            $num = Fraction::createFractionFromMixed($num); 
        }

        $denominator = $this->denominator->mul($num->denominator);

        $numerator1 = $this->numerator->mul($num->denominator);
        $numerator2 = $num->numerator->mul($this->denominator);

        if ($this->sign === Sign::Minus) {
            $numerator1 = -$numerator1;
        }
        if ($num->sign === Sign::Minus) {
            $numerator2 = -$numerator2;
        }

        $numerator = $isAdd ? $numerator1->add($numerator2) : $numerator1->sub($numerator2);

        return new Fraction($numerator, $denominator);
    }

    public function mul(Fraction|Number|int|string $num): Fraction
    {
        if (!$num instanceof Fraction) {
            $num = Fraction::createFractionFromMixed($num); 
        }

        $numerator = $this->numerator->mul($num->numerator);
        $denominator = $this->denominator->mul($num->denominator);

        if ($this->sign !== $num->sign) {
            $numerator = -$numerator;
        }

        return new Fraction($numerator, $denominator);
    }

    public function div(Fraction|Number|int|string $num): Fraction
    {
        if (!$num instanceof Fraction) {
            $num = Fraction::createFractionFromMixed($num); 
        }

        if ($num->numerator == 0) {
            throw new InvalidArgumentException('Division by zero');
        }

        $numerator = $this->numerator->mul($num->denominator);
        $denominator = $this->denominator->mul($num->numerator);

        if ($this->sign !== $num->sign) {
            $numerator = -$numerator;
        }

        return new Fraction($numerator, $denominator);
    }

    public function mod(Fraction|Number|int|string $num): Fraction
    {
        if (!$num instanceof Fraction) {
            $num = Fraction::createFractionFromMixed($num); 
        }

        if ($num->numerator == 0) {
            throw new InvalidArgumentException('Modulo by zero');
        }

        $denominator = $this->denominator->mul($num->denominator);

        $numerator1 = $this->numerator->mul($num->denominator);
        $numerator2 = $num->numerator->mul($this->denominator);

        if ($this->sign === Sign::Minus) {
            $numerator1 = -$numerator1;
        }

        $rem = $numerator1 % $numerator2;

        return new Fraction($rem, $denominator);
    }

    /** @return Fraction[] */
    public function divmod(Fraction|Number|int|string $num): array
    {
        if (!$num instanceof Fraction) {
            $num = Fraction::createFractionFromMixed($num); 
        }

        if ($num->numerator == 0) {
            throw new InvalidArgumentException('Division by zero');
        }

        $denominator = $this->denominator->mul($num->denominator);

        $numerator1 = $this->numerator->mul($num->denominator);
        $numerator2 = $num->numerator->mul($this->denominator);

        [$quot, $rem] = $numerator1->divmod($numerator2);

        if ($this->sign !== $num->sign) {
            $quot = -$quot;
        }

        if ($this->sign === Sign::Minus) {
            $rem = -$rem;
        }

        return [
            new Fraction($quot),
            new Fraction($rem, $denominator),
        ];
    }

    public function pow(Number|int|string $exponent): Fraction
    {
        if (!$exponent instanceof Number) {
            $exponent = new Number($exponent);
        }

        if ($exponent->scale !== 0) {
            throw new InvalidArgumentException('The exponent must be an integer');
        }

        if ($exponent == 0) {
            return new Fraction(1);
        }

        $numerator = $this->sign === Sign::Minus ? -$this->numerator : $this->numerator;

        return match (true) {
            $exponent > 0 => new Fraction($numerator->pow($exponent), $this->denominator->pow($exponent)),
            $exponent < 0 => $this->numerator == 0
                ? throw new InvalidArgumentException('Negative power of zero')
                : new Fraction($this->denominator->pow(-$exponent), $numerator->pow(-$exponent)),
        };
    }

    public function compare(Fraction|Number|int|string $num): int
    {
        if (!$num instanceof Fraction) {
            $num = Fraction::createFractionFromMixed($num); 
        }

        $numerator1 = $this->numerator->mul($num->denominator);
        $numerator2 = $num->numerator->mul($this->denominator);

        if ($this->sign === Sign::Minus) {
            $numerator1 = -$numerator1;
        }
        if ($num->sign === Sign::Minus) {
            $numerator2 = -$numerator2;
        }

        return $numerator1 <=> $numerator2;
    }

    private function getGcd(Number $num1, Number $num2): Number
    {
        while (1) {
            $r = $num1 % $num2;
            if ($r == 0) {
                return $num2;
            }
            $num1 = $num2;
            $num2 = $r;
        }
    }

    public function toNumber(): Number
    {
        if (!is_null($this->numberCache->value)) {
            return $this->numberCache->value;
        }

        $numeratorLen = strlen($this->numerator);
        $denominatorLen = strlen($this->denominator);
        $scale = $numeratorLen < $denominatorLen ? $denominatorLen - $numeratorLen : 0;
        if ($scale > 0) {
            $zeros = str_repeat('0', $scale);
            $add = '0.' . $zeros;
            $numerator = $this->numerator->add($add);
        } else {
            $numerator = $this->numerator;
        }

        if ($this->sign === Sign::Minus) {
            $numerator = -$numerator;
        }

        $this->numberCache->value = $numerator->div($this->denominator);

        return $this->numberCache->value;
    }

    public function __toString(): string
    {
        if (!is_null($this->stringCache->value)) {
            return $this->stringCache->value;
        }

        $sign = $this->sign === Sign::Minus ? '-' : '';
        $this->stringCache->value = "{$sign}{$this->numerator}/{$this->denominator}";

        return $this->stringCache->value;
    }

    public function __serialize(): array
    {
        return [
            'numerator' => ($this->sign === Sign::Minus ? '-' : '') . (string) $this->numerator,
            'denominator' => (string) $this->denominator,
        ];
    }

    public function __unserialize(array $data): void
    {   
        if (
            !isset($data['numerator'], $data['denominator']) ||
            !is_string($data['numerator']) ||
            !is_string($data['denominator'])
        ) {
            throw new InvalidArgumentException('Invalid serialized data');
        }

        $numerator = new Number($data['numerator']);
        $denominator = new Number($data['denominator']);

        if (
            $numerator->scale !== 0 ||
            $denominator->scale !== 0 ||
            $denominator <= 0
        ) {
            throw new InvalidArgumentException('Invalid serialized data');
        }

        if ($numerator >= 0) {
            $this->sign = Sign::Plus;
        } else {
            $this->sign = Sign::Minus;
            $numerator = -$numerator;
        }

        $commonDivisor = $this->getGcd($numerator, $denominator);

        $this->numerator = $numerator->div($commonDivisor);
        $this->denominator = $denominator->div($commonDivisor);
        $this->numberCache = new NumberCache();
        $this->stringCache = new StringCache();
    }
}
