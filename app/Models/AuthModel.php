<?php

namespace App\Models;

class AuthModel
{
    protected string $accessToken;
    protected string $type;
    protected string $liveTime;

    public function __construct(string $accessToken, string $type, string $liveTime) {
        $this->accessToken = $accessToken;
        $this->type = $type;
        $this->liveTime = $liveTime;
    }
}
