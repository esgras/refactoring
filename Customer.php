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
            $thisAmount = $this->amountFor($each);

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


    private function amountFor(Rental $rental)
    {
        $result = 0;
        switch ($rental->getMovie()->getPriceCode()) {
            case Movie::REGULAR:
                $result += 2;
                if ($rental->getDaysRented() > 2) {
                    $result += ($rental->getDaysRented() - 2) * 1.5;
                }
                break;
            case Movie::NEW_RELEASE:
                $result += $rental->getDaysRented() * 3;
                break;
            case Movie::CHILDRENS:
                $result += 1.5;
                if ($rental->getDaysRented() > 3) {
                    $result += ($rental->getDaysRented() - 3) * 1.5;
                }
                break;
        }

        return $result;
    }
}