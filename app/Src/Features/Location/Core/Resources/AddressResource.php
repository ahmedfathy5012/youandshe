<?php

namespace Src\Features\Location\Core\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AddressResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id??0,
            'address' => $this->address??'',
            'lat' => strval($this->lat??''),
            'lon' => strval($this->lon??''),
            'name' => $this->name??'',
            'address_type_id' => intval($this->address_type_id??0),
            'status' => intval($this->status??0),
        ];
    }
}
