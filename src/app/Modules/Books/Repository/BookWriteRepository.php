<?php


namespace App\Modules\Books\Repository;


use App\Modules\Books\DTO\CreateBookDTO;
use App\Modules\Books\DTO\UpdateBookDTO;
use App\Modules\Books\Models\Books;

class BookWriteRepository implements BookWriteRepositoryInterface
{

    public Books $model;

    public function __construct(Books $model)
    {
        $this->model = $model;
    }

    public function create(CreateBookDTO $DTO)
    {
        return $this->model->create(get_object_vars($DTO));
    }

    public function update($id, UpdateBookDTO $DTO)
    {
        $model = $this->model->where('id', '=', $id)->first();
        $model->update(get_object_vars($DTO));
        return $model;
    }
}
