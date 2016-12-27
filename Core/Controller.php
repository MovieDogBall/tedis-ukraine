<?php

namespace Core;


class Controller
{

    /** @var array */
    private $nodeTree;

    /**
     * Controller constructor.
     * @param $db
     */
    public function __construct($db)
    {
        if (is_null($db)) {
            $this->dataStore = new FileDataStore();
        } else {
            $this->dataStore = new DbDataStore($db);
        }

    }

    /**
     * @return array
     */
    public function getNodeTree()
    {
        return $this->getStoredTree()->getTree();
    }

    /**
     * @param $request
     */
    public function updateNodeTree(Request $request)
    {
        $existedTree = $this->getStoredTree();
        $node = $existedTree->handleNode($request);
        $existedTree->updateTree($node, $request);
        $updatedTree = $existedTree->getJson();
        $this->dataStore->update($updatedTree);
    }

    /**
     * @return \Core\NodeTree
     */
    private function getStoredTree()
    {
        $dataFromDB = $this->dataStore->get();
        return new NodeTree($dataFromDB);
    }
}