<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StudentResource extends JsonResource
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
            'nik' => $this->nik,
            'name' => $this->name,
            'gender' => $this->gender == 'L' ? 'Laki-laki' : 'Perempuan',
            'department' => $this->department->name
        ];
    }
}
