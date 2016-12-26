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
        $this->dataStore = new FileDataStore();
        $this->db = new Db($db);
    }

    public function getNodeTree(){
        return $this->getStoredTree()->getJson();
    }

    /**
     * @param $request
     */
    public function updateNodeTree(Request $request){
        $existedTree = $this->getStoredTree();
        $node = $existedTree->handleNode($request);
        $existedTree->updateTree($node, $request);
        $updatedTree = $existedTree->getJson();
        $this->dataStore->update($updatedTree);
    }

    /**
     * @return \Core\NodeTree
     */
    private function getStoredTree(){
        $dataFromDB = $this->db->get();
        return new NodeTree($dataFromDB);
    }
}