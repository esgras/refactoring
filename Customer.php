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
        $result = "Учет аренды для " . $this->getName() . "\n";

        foreach ($this->rentals as $each) {
            $result .= "\t" . $each->getMovie()->getTitle() . "\t" . $each->getCharge() . PHP_EOL;
        }

        $result .= "Сумма задолженности составляет " . $this->getTotalCharge() . PHP_EOL;
        $result .= "Вы заработали " . $this->getTotalFrequentRenterPoints() . " очков за активность";

        return $result;
    }

    public function htmlStatement(): string
    {
        $result = "<h1>Операция аренды для <em>" . $this->getName() . "</EM></H1><p>\n";
        foreach ($this->rentals as $each) {
            $result .= $each->getMovie()->getTitle() . ": "
                . $each->getCharge() . "<BR>";
        }
        $result .= "</p><p>Ваша задолженость составляет <em>" . $this->getTotalCharge() . "</em></p>";
        $result .= "<p>На этой аренде вы заработали <em>" . $this->getTotalFrequentRenterPoints() . "</em> очков за активность</p>";

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