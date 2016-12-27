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
     * @return NodeTree
     * @throws \Exception
     */
    private function getStoredTree()
    {
        $dataFromDB = $this->dataStore->get();

        if(is_null($dataFromDB)){
            throw new \Exception("Data From Data Store is Null");
        }

        return new NodeTree($dataFromDB);
    }
}