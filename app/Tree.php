<?php

namespace App;

use App\Repositories\Projects;
use App\Http\Resources\Git\TreeResource;
use App\Api\Git\BaseModel;

class Tree extends BaseModel
{
    protected $branch = 'master';

    /**
     * @param $userName
     * @param $projecSlug
     * @param null $options
     * @return \GitElephant\Objects\Tree|null
     */
    public function get($userName, $projecSlug, $options = null)
    {
        if ($options !== null) $this->_configure($options);

        $repo = Repo::open($userName, $projecSlug);
        $branch = $repo->getBranch($this->branch);

        if ($repo && (null !== $branch)) {

            return $repo->getTree($branch, $this->path);
        }
        return null;
    }
}
