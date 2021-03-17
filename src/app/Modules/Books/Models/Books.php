<?php


namespace App\Modules\Books\Models;


use App\Modules\Authors\Models\Author;
use App\Modules\Authors\Models\AuthorBooks;
use App\Modules\Books\database\factories\BookFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Books extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description'
    ];
    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory(): \Illuminate\Database\Eloquent\Factories\Factory
    {
        return BookFactory::new();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function author()
    {
        return $this->belongsToMany(Author::class, 'author_books', 'books_id', 'author_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function authorBooks()
    {
        return $this->belongsTo(AuthorBooks::class,'id','books_id',);
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeWithAuthor($query)
    {
        return $query->with('author');
    }

    public function scopeGetById($query, $id)
    {
        return $query->where('books.id', '=', $id)->first();
    }

}
