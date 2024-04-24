<?php

namespace Src\Features\Booking\Data\Models;

class Price
{


    private string $price;
    private string $discount;
    private string $total;
    private ?string $message;
    private bool $hasError;

    /**
     * @param string $price
     * @param string $discount
     * @param string $total
     * @param string|null $message
     * @param bool $hasError
     */
    public function __construct(string $price, string $discount, string $total, ?string $message=null, bool $hasError=false)
    {
        $this->price = $price;
        $this->discount = $discount;
        $this->total = $total;
        $this->message = $message;
        $this->hasError = $hasError;
    }

    /**
     * @return bool
     */
    public function isHasError(): bool
    {
        return $this->hasError;
    }




    /**
     * @return string|null
     */
    public function getMessage(): ?string
    {
        return $this->message;
    }


    /**
     * @return string
     */
    public function getPrice(): float
    {
        return floatval($this->price);
    }

    /**
     * @return string
     */
    public function getDiscount(): float
    {
        return floatval($this->discount);
    }

    /**
     * @return string
     */
    public function getTotal(): float
    {
        return floatval($this->total);
    }





}
