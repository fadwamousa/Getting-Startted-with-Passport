<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Contact extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        //return parent::toArray($request);

        return [
          'FullName' => $this->name,
          'Mobile'   => $this->phone,
          'Date'     => $this->created_at->diffForHumans()
        ];
    }
}
