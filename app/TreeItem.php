<?php

namespace App;

use App\Api\BaseModel;

class TreeItem extends BaseModel
{
    protected $name;

    protected $type;

    protected $commit;

    public function __construct($name, $type)
    {
        $this->name = $name;
        $this->type = $type;
    }

    public function getCommit($author, $message)
    {
        if (is_null($this->commit)) {
            $this->commit = new Commit($author, $message);
        }

        return $this->commit;
    }
}
