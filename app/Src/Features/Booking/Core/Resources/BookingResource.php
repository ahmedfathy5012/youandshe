<?php

namespace Src\Features\Booking\Core\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Src\Features\BaseApp\Core\Resources\PackageResource;
use Src\Features\BaseApp\Core\Resources\ServiceResource;
use Src\Features\BaseApp\Data\Models\Package;
use Src\Features\Location\Core\Resources\AddressResource;

class BookingResource extends JsonResource
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
            'user_id' => $this->user_id??'',
            'barber_id' => $this->barber_id??'',
            'status' => intval($this->status??0),
            'address' => new AddressResource($this->address),
            'date' => $this->date??'',
            'time' => $this->time??'',
            'price' => strval($this->price??''),
            'discount' => strval($this->discount??''),
            'total' => strval($this->total??''),
            'package' =>new PackageResource(Package::find($this->package_id)),
            'services' => $this->services!=null?
                ServiceResource::collection($this->services) :[]
        ];
    }
}
