<?php

namespace App\Models;


class CategoryFilter
{
    public $tagsid;
    public $isdeleted;
    public $created_at;
    public $deleted_at;

    public function __constuctor(int $tagsid, bool $isdeleted, $created_at, $deleted_at)
    {
        $this->tagsid = $tagsid;
        $this->isdeleted = $isdeleted;
        $this->created_at = $created_at;
        $this->deleted_at = $deleted_at;
    }


}