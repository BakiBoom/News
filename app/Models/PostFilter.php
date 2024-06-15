<?php

namespace App\Models;

class PostFilter
{
    public $title;
    public $categorysid;
    public $tagsid;
    public $isdeleted;
    public $created_at;
    public $deleted_at;

    public function __constuctor(string $title, int $categorysid, int $tagsid, bool $isdeleted, $created_at, $deleted_at)
    {
        $this->title = $title;
        $this->categorysid = $categorysid;
        $this->tagsid = $tagsid;
        $this->isdeleted = $isdeleted;
        $this->created_at = $created_at;
        $this->deleted_at = $deleted_at;
    }
}