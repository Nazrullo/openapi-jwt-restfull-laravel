<?php


namespace App\Modules\Books\DTO;


class CreateBookDTO
{
    /**
     * @var
     */
    public $name;
    /**
     * @var
     */
    public $description;

    public function __construct($name, $description)
    {
        $this->name = $name;
        $this->description = $description;

    }
}
