<?php


namespace App\Modules\Books\Repository;


use App\Modules\Books\DTO\CreateBookDTO;
use App\Modules\Books\DTO\UpdateBookDTO;

interface BookWriteRepositoryInterface
{
    public function create(CreateBookDTO $DTO);

    public function update($id, UpdateBookDTO $DTO);
}
