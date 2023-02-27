<?php

namespace App\Http\Resources;

use App\Constants\RecordStatusConstants;
use Illuminate\Http\Resources\Json\JsonResource;

class ProgramResource extends JsonResource
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
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'pentesting_start_date' => $this->pentesting_start_date,
            'pentesting_end_date' => $this->pentesting_end_date,
            'status' => RecordStatusConstants::STATUS[$this->record_status]['label'],
            'created_by' => new UserResource($this->user),
        ];
    }
}
