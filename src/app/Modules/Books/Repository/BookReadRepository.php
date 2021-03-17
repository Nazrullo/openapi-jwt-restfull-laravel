<?php


namespace App\Modules\Books\Repository;


use App\Modules\Books\Models\Books;

class BookReadRepository implements BookReadRepositoryInterface
{
    /**
     * @var Books
     */
    public $model;

    public function __construct(Books $model)
    {
        $this->model = $model;
    }

    /**
     * @return mixed
     */
    public function all()
    {
        return $this->model->withAuthor()->get();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function first($id)
    {
        return $this->model->withAuthor()->getById($id);
    }

    /**
     * @param $author_id
     * @return mixed
     */
    public function getBooksByAuthorId($author_id)
    {
        return $this->model->whereHas('authorBooks', function ($e) use ($author_id) {
            return $e->where('author_id', '=', $author_id);
        })->get();
    }


}
