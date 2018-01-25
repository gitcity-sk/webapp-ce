<?php

namespace App;

use App\Api\BaseModel;

class Commit extends BaseModel
{
    protected $author;

    protected $message;

    public function __construct($author, $message)
    {
        $this->author = $author;
        $this->message = $message;
    }
}
