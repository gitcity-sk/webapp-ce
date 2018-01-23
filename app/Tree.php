<?php

namespace App;

use App\Repositories\Projects;
use App\Api\BaseModel;

class Tree extends BaseModel
{
    protected $readme;

    protected $tree;

    public function get($userName, $projecSlug)
    {
        $repo = Repo::open($userName, $projecSlug);

        if ($repo && (count($repo->getBranches(true)) != 0)) {
            $tree = null;

            try {
                $tree = $repo->getTree('HEAD');
                $this->readme = $repo->outputRawContent($repo->getTree('HEAD', 'README.md')->getObject(), 'HEAD');

                $this->serialize($tree);
            } catch (\Exception $e) {
                // nothing to do
            }
        }

        return $this;
    }

    protected function serialize($tree)
    {
        if (null != $tree)
        {
            foreach ($tree as $treeObject) {

                $treeItem = new TreeItem($treeObject->getName(), $treeObject->getType());
                $treeItem->getCommit($treeObject->getLastCommit()->getAuthor()->getName(), $treeObject->getLastCommit()->getMessage()->getShortMessage());

                $this->tree[] = $treeItem;
            }
        }
    }
}
