<?php

namespace App;

use App\Api\Git\BaseModel;

class Blob extends BaseModel
{
    protected $path;

    protected $branch = 'HEAD';

    public function get($userName, $projectSlug, $options = null)
    {
        if ($options !== null) $this->_configure($options);

        $repo = Repo::open($userName, $projectSlug);

        if ($repo && (count($repo->getBranches(true)) != 0)) {

            $tree = $repo->getTree($this->branch, $this->path);
            $treeObject = $tree->getBlob();

            return $repo->outputContent($treeObject, $this->branch);
        }

        return null;
    }
}
