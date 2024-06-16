<?php

namespace App\Models;

class PostFilter
{
    public $title;
    public $categorysid;
    public $tagsid;
    public $isdeleted;
    public $startdate;
    public $enddate;

    public function __constuctor(string $title, int $categorysid, int $tagsid, bool $isdeleted, $startdate, $enddate)
    {
        $this->title = $title;
        $this->categorysid = $categorysid;
        $this->tagsid = $tagsid;
        $this->isdeleted = $isdeleted;
        $this->startdate = $startdate;
        $this->enddate = $enddate;
    }
}