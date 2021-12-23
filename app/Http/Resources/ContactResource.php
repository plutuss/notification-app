<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ContactResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'name' => $this->name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'jobs' => $this->jobs,
            'address' => $this->address,
        ];
    }
}
