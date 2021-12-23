<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LetterResource extends JsonResource
{

    /**
     * @param  Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'subject' => $this->subject,
            'body' => $this->body,
        ];
    }
}
