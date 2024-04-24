<?php

namespace Src\Features\Booking\Core\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Src\Features\Booking\Data\Models\Price;

class PriceResource extends JsonResource
{

    private Price $price;

    /**
     * @param Price $price
     */
    public function __construct(Price $price)
    {
        $this->price = $price;
    }


    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'price' => $this->price->getPrice()??'',
            'title'=>  $this->price->getDiscount()??'',
            'total' => $this->price->getTotal()??''
        ];
    }
}
