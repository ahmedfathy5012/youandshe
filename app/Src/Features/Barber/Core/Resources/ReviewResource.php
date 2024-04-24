<?php

namespace Src\Features\Barber\Core\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ReviewResource extends JsonResource
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
            'user_name' => $this->user!=null ?$this->user->name??'':'',
            'user_image' => $this->user!=null ?$this->user->image??'':'',
            'comment' => $this->comment??'',
            'rate' => intval($this->rate??0),
            'duration' => strval($this->created_at)??'',
        ];
    }
}
