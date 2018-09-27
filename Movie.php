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

}