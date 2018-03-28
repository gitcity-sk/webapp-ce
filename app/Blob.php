<?php

namespace App;

use App\Api\Git\BaseModel;
use App\Http\Resources\Git\BlobResource;

class Blob extends BaseModel
{
    protected $path;

    protected $branch = 'master';

    /**
     * @param string $userName
     * @param string $projectSlug
     * @param array|null $options
     */
    public function get($userName, $projectSlug, $options = null)
    {
        if ($options !== null) $this->_configure($options);

        $repo = Repo::open($userName, $projectSlug);
        $branch = $repo->getBranch($this->branch);

        if ($repo && (null !== $branch)) {
            $tree = $repo->getTree($branch, $this->path);
            $treeObject = $tree->getBlob();

            // prepare Blob resource
            $response = new BlobResource($treeObject->getName(), $treeObject->getSize());

            try {
                if (request()->has('format') && request('format') == 'raw') return $response->setContent($repo->outputRawContent($treeObject, $branch))->toArray();
                
                return $response->setContent($repo->outputContent($treeObject, $branch))->toArray();
            } catch (\InvalidArgumentException $e) {
                // do nothing
            }
            
        }

        return null;
    }
}
