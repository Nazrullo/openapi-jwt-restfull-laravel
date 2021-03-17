<?php


namespace App\Modules\Books\Repository;


interface BookReadRepositoryInterface
{
    public function all();

    public function first($id);

    public function getBooksByAuthorId($author_id);
}
