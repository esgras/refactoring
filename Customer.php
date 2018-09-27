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
            $thisAmount = 0;

            switch ($each->getMovie()->getPriceCode()) {
                case Movie::REGULAR:
                    $result += 2;
                    if ($each->getDaysRented() > 2) {
                        $result += ($each->getDaysRented() - 2) * 1.5;
                    }
                    break;
                case Movie::NEW_RELEASE:
                    $result += $each->getDaysRented() * 3;
                    break;
                case Movie::CHILDRENS:
                    $result += 1.5;
                    if ($each->getDaysRented() > 3) {
                        $result += ($each->getDaysRented() - 3) * 1.5;
                    }
                    break;
            }

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