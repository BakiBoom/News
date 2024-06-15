<?php

namespace App\Models;


class TagFilter
{
    public $isdeleted;
    public $created_at;
    public $deleted_at;

    public function __constuctor(bool $isdeleted, $created_at, $deleted_at)
    {
        $this->isdeleted = $isdeleted;
        $this->created_at = $created_at;
        $this->deleted_at = $deleted_at;
    }


}