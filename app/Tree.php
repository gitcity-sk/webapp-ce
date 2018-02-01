<?php

namespace App;

use App\Repositories\Projects;
use App\Http\Resources\Git\TreeResource;
use App\Api\Git\BaseModel;

class Tree extends BaseModel
{
    protected $readme;

    protected $tree;

    protected $lastCommit;

    public function get($userName, $projecSlug)
    {
        $repo = Repo::open($userName, $projecSlug);

        if ($repo && (count($repo->getBranches(true)) != 0)) {
            $tree = null;

            try {
                $tree = $repo->getTree('HEAD');
                $this->readme = $repo->outputRawContent($repo->getTree('HEAD', 'README.md')->getObject(), 'HEAD');

                $this->lastCommit = [
                    'author' => $tree->getLastCommitAuthor()->getName(),
                    'message' => $tree->getLastCommitMessage()->getShortMessage()
                ];

                $this->build($tree);
            } catch (\Exception $e) {
                // nothing to do
            }
        }

        return $this->withClosure();
    }

    protected function withClosure()
    {
        return [
            'data' => $this->tree,
            'last_commit' => $this->lastCommit
        ];
    }

    protected function build($tree)
    {
        if (null != $tree)
        {
            foreach ($tree as $treeObject) {
                $treeItem = new TreeResource($treeObject);
                $this->tree[] = $treeItem->toArray();
            }
        }
    }
}
