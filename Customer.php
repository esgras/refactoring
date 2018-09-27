<?php

namespace Ref;

class Customer
{
    private $name;

    /**
     * @var Rental[]
     */
    private $rentals = [];

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function addRental(Rental $rental): self
    {
        $this->rentals[] = $rental;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function statement(): string
    {
        $frequentRenterPoints = 0;
        $rentals = $this->rentals;
        $result = "Учет аренды для " . $this->getName() . "\n";

        foreach ($rentals as $each) {
            $frequentRenterPoints += $each->getFrequentRenterPoints();

            $result .= "\t" . $each->getMovie()->getTitle() . "\t" . $each->getCharge() . PHP_EOL;
        }

        $result .= "Сумма задолженности составляет " . $this->getTotalCharge() . PHP_EOL;
        $result .= "Вы заработали " . $frequentRenterPoints . "очков за активность";

        return $result;
    }

    public function getTotalCharge()
    {
        return array_reduce($this->rentals, function($rental, $sum) {
            return $rental->getCharge() + $sum;
        }, 0);
    }

}