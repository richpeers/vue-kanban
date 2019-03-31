<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Column as ColumnResource;

class Board extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'hashId' => $this->hashId,
            'title' => $this->title,
            'columns' => ColumnResource::collection($this->whenLoaded('columns')),
            'private' => $this->private
        ];
    }
}
