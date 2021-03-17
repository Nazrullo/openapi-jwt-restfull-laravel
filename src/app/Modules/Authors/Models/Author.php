<?php


namespace App\Modules\Authors\Models;


use App\Modules\Authors\database\factories\AuthorFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [
        'full_name',
        'birth_date',
        'about'
    ];

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory(): \Illuminate\Database\Eloquent\Factories\Factory
    {
        return AuthorFactory::new();
    }
}
