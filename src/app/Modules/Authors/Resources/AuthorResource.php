<?php


namespace App\Modules\Authors\Resources;


use Illuminate\Http\Resources\Json\JsonResource;

class AuthorResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'full_name' => $this->full_name,
            'about' => $this->about,
            'birth_date' => $this->birth_date
        ];
    }

}
