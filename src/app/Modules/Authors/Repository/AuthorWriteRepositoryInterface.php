<?php


namespace App\Modules\Authors\Repository;



use App\Modules\Authors\DTO\CreateAuthorDTO;

interface  AuthorWriteRepositoryInterface
{
    public function create(CreateAuthorDTO $DTO);
}
