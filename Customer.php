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
        $totalAmount = 0;
        $frequentRenterPoints = 0;
        $rentals = $this->rentals;
        $result = "Учет аренды для " . $this->getName() . "\n";

        foreach ($rentals as $each) {
            $thisAmount = $each->getCharge();

            $frequentRenterPoints++;

            if ($each->getMovie()->getPriceCode() == Movie::NEW_RELEASE
                && $each->getDaysRented() > 1
            ) {
                $frequentRenterPoints++;
            }

            $result .= "\t" . $each->getMovie()->getTitle() . "\t" . $thisAmount . PHP_EOL;
        }

        $result .= "Сумма задолженности составляет " . $totalAmount . PHP_EOL;
        $result .= "Вы заработали " . $frequentRenterPoints . "очков за активность";

        return $result;
    }

}