<?php

namespace Ref;

use Ref\Prices\ChildrensPrice;
use Ref\Prices\NewReleasePrice;
use Ref\Prices\RegularPrice;

class Movie
{
    const CHILDRENS = 2;
    const REGULAR = 0;
    const NEW_RELEASE = 1;

    private $title;
    /** @var  Price */
    private $price;

    public function __construct(string $title, int $priceCode)
    {
        $this->title = $title;
        $this->setPriceCode($priceCode);
    }

    /**
     * @return int
     */
    public function getPriceCode(): int
    {
        return $this->price->getPriceCode();
    }

    /**
     * @param int $priceCode
     * @return Movie
     */
    public function setPriceCode(int $priceCode): self
    {
        switch ($priceCode) {
            case self::REGULAR:
                $this->price = new RegularPrice();
            break;
            case self::NEW_RELEASE:
                $this->price = new NewReleasePrice();
            break;
            case self::CHILDRENS:
                $this->price = new ChildrensPrice();
            break;
        }

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
        return $this->price->getCharge($daysRented);
    }

    public function getFrequentRenterPoints(int $daysRented): int
    {
        return $this->price->getFrequentRenterPoints($daysRented);

        if ($this->getPriceCode() == Movie::NEW_RELEASE
            && $daysRented > 1
        ) {
            return 2;
        } else {
            return 1;
        }
    }

}