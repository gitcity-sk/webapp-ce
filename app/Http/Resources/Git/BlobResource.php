<?php

namespace App\Http\Resources\Git;

class BlobResource
{
    protected $name;

    protected $size;

    protected $content;

    public function __construct($name, $size)
    {
        if (null !== $name) $this->name = $name;
        if (null !== $size) $this->size = $size;
    }

    public function setContent($content)
    {
        if (null !== $content) $this->content = $content;

        return $this;
    }

    public function toArray()
    {
        return [
            'name' => $this->name,
            'size' => size_for_humans($this->size),
            'content' => $this->content
        ];
    }
}
