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
        $this->dataStore = new FileDataStore($db);
    }

    public function getNodeTree(){
        $tree = $this->getStoredTree()->getTree();

        $subTree = $this->getSubTree($tree);

        return $subTree;

    }

    private function getSubTree($tree){
        $subTree = "";

        foreach ($tree as $key => $value){
            if(is_array($value)){
                $subTree .= "<ul>";
                $subTree .= $this->getSubTree($value);
            } else {
                var_dump($value);
                $subTree .= "<li>" .$value['name'];
            }

            $subTree .= "</ul>";
        }

        return $subTree;
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
        $dataFromDB = $this->dataStore->get();
        return new NodeTree($dataFromDB);
    }
}