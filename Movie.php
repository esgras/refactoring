<?php

namespace Ref;

class Movie
{
    const CHILDRENS = 2;
    const REGULAR = 0;
    const NEW_RELEASE = 1;

    private $title;
    private $priceCode;

    public function __construct(string $title, int $priceCode)
    {
        $this->title = $title;
        $this->priceCode = $priceCode;
    }

    /**
     * @return int
     */
    public function getPriceCode(): int
    {
        return $this->priceCode;
    }

    /**
     * @param int $priceCode
     * @return Movie
     */
    public function setPriceCode(int $priceCode): self
    {
        $this->priceCode = $priceCode;
        return $this;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    public function getCharge(int $daysRented): float
    {
        $result = 0;
        switch ($this->getPriceCode()) {
            case Movie::REGULAR:
                $result += 2;
                if ($daysRented > 2) {
                    $result += ($daysRented - 2) * 1.5;
                }
                break;
            case Movie::NEW_RELEASE:
                $result += $daysRented * 3;
                break;
            case Movie::CHILDRENS:
                $result += 1.5;
                if ($daysRented > 3) {
                    $result += ($daysRented - 3) * 1.5;
                }
                break;
        }

        return $result;
    }

    public function getFrequentRenterPoints(int $daysRented): int
    {
        if ($this->getPriceCode() == Movie::NEW_RELEASE
            && $daysRented > 1
        ) {
            return 2;
        } else {
            return 1;
        }
    }

}