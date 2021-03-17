<?php


namespace App\Modules\Books\Resources;


use App\Modules\Authors\Resources\AuthorResource;
use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
{

    public function toArray($request)
    {
        if (!empty($this->author)) {
            $authors =  AuthorResource::collection($this->author);
        } else {
            $authors = [];
        }
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'authors' => $authors
        ];
    }

}
