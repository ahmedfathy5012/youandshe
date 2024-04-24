<?php

namespace Src\Features\Auth\Core\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
//            'password'=>$this->password??'',
            'phone' => $this->phone??'',
            'phone_verify' => $this->phone_verify??0,
            'api_token' => $this->api_token??'',
            'gender' => $this->gender??0,
            'device_id' => $this->device_id??'',
            'service_gender' => $this->service_gender??0,
            'status' => $this->status??0,
            'image' => $this->image??'',
            'ready_to_notify' => $this->ready_to_notify??1,
        ];
    }
}
