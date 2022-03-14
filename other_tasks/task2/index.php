<?php

abstract class CarDetail
{
    protected $isBroken;
    protected $isPaintingDamaged;

    public function __construct(bool $isBroken, bool $isPaintingDamaged)
    {
        $this->isBroken = $isBroken;
        $this->isPaintingDamaged = $isPaintingDamaged;
    }

    public function isBroken(): bool
    {
        return $this->isBroken;
    }

    public function isPaintingDamaged(): bool
    {
        return $this->isPaintingDamaged;
    }
}

class Door extends CarDetail
{
}

class Tyre extends CarDetail
{
}

class Car
{
    /**
     * @var CarDetail[]
     */
    private $details;

    /**
     * @param CarDetail[] $details
     */
    public function __construct(array $details)
    {
        $this->details = $details;
    }

    /**
     * As isBroken and isPaintingDamaged logically are same so whether car is broken or painting
     * is damaged then it will consider as damaged.
     * @param string $method
     * @return bool
     */
    private function isCarDamaged(string $method): bool
    {
        foreach ($this->details as $detail) {
            if ($detail->$method()) {
                return true;
            }
        }
        return false;
    }

    public function isBroken(): bool
    {
        return $this->isCarDamaged("isBroken");
    }

    public function isPaintingDamaged(): bool
    {
        return $this->isCarDamaged("isPaintingDamaged");
    }
}

$car = new Car([new Door(true, false), new Tyre(false, false)]);
var_dump($car->isPaintingDamaged());
