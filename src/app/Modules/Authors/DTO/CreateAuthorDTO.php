<?php


namespace App\Modules\Authors\DTO;


class CreateAuthorDTO
{
    public $full_name;
    public $birth_date;
    public $about;

    public function __construct($full_name, $birth_date, $about)
    {
        $this->full_name = $full_name;
        $this->birth_date = $birth_date;
        $this->about = $about;
    }

}
