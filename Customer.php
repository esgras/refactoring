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
        $rentals = $this->rentals;
        $result = "Учет аренды для " . $this->getName() . "\n";

        foreach ($rentals as $each) {
            $result .= "\t" . $each->getMovie()->getTitle() . "\t" . $each->getCharge() . PHP_EOL;
        }

        $result .= "Сумма задолженности составляет " . $this->getTotalCharge() . PHP_EOL;
        $result .= "Вы заработали " . $this->getTotalFrequentRenterPoints() . "очков за активность";

        return $result;
    }

    private function getTotalCharge()
    {
        return array_reduce($this->rentals, function ($rental, $sum) {
            return $rental->getCharge() + $sum;
        }, 0);
    }

    private function getTotalFrequentRenterPoints()
    {
        return array_reduce($this->rentals, function ($rental, $sum) {
            return $rental->getFrequentRenterPoints() + $sum;
        }, 0);
    }

}