<?php


namespace App\Modules\Authors\Repository;


use App\Modules\Authors\DTO\CreateAuthorDTO;
use App\Modules\Authors\Models\Author;

class AuthorWriteRepository implements AuthorWriteRepositoryInterface
{
    /**
     * @var Author
     */
    protected $model;

    public function __construct(Author $model)
    {
        $this->model = $model;
    }

    public function create(CreateAuthorDTO $DTO)
    {
        return $this->model->create(get_object_vars($DTO));
    }

}
