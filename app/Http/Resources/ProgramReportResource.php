<?php

namespace App\Http\Resources;

use App\Constants\RecordStatusConstants;
use App\Constants\RequestStatusConstants;
use App\Constants\SeverityConstant;
use Illuminate\Http\Resources\Json\JsonResource;

class ProgramReportResource extends JsonResource
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
            'severity' => SeverityConstant::LEVELS[$this->severity]['label'],
            'request' => RequestStatusConstants::STATUS[$this->request_status]['label'],
            'status' => RecordStatusConstants::STATUS[$this->record_status]['label'],
        ];
    }
}
