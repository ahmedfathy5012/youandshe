<?php

namespace Src\Features\Barber\Core\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BarberResource extends JsonResource
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
            'name'=>$this->name??'',
            'phone' => $this->phone??'',
            'phone_verify' => $this->phone_verify??0,
            'api_token' => $this->api_token??'',
            'gender' => $this->gender??0,
            'device_id' => $this->device_id??'',
            'service_gender' => $this->service_gender??0,
            'status' => $this->status??0,
            'image' => $this->image??'',
            'ready_to_notify' => $this->ready_to_notify??1,
            'ready_to_work' => $this->ready_to_work??1,
            
        ];
    }
}
