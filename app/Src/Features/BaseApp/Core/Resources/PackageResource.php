<?php

namespace Src\Features\BaseApp\Core\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PackageResource extends JsonResource
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
            'name' => $this->name??'',
            'icon' => $this->icon??'',
//          'duration' => strval($this->duration??0),
            'price' => strval($this->price??0)
        ];
    }
}
