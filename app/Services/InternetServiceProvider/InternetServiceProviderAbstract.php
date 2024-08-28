<?php

namespace App\Services\InternetServiceProvider;

abstract class InternetServiceProviderAbstract implements InternetServiceProviderInterface
{
    protected string $operator;
    protected int $month;
    protected int $monthlyFees;

    public final function __construct()
    {
        if (!isset($this->operator)) {
            throw new \LogicException(get_class($this).' must have a $operator property.');
        }

        if (!isset($this->month)) {
            throw new \LogicException(get_class($this).' must have a $month property.');
        }

        if (!isset($this->monthlyFees)) {
            throw new \LogicException(get_class($this).' must have a $monthlyFees property.');
        }
    }

    abstract public function setMonth(int $month);

    abstract public function calculateTotalAmount(): float|int;
}