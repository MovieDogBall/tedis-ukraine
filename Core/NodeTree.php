<?php

namespace Core;


class NodeTree
{
    /**
     * @var array
     */
    private $tree = [];

    /**
     * NodeTree constructor.
     * @param array $tree
     */
    public function __construct(array $tree)
    {
        $this->tree = $tree;
    }

    /**
     * @return array
     */
    public function getTree()
    {
        return $this->tree;
    }

    /**
     * @return mixed
     */
    public function getJson()
    {
        return json_encode($this->tree);
    }

    /**
     * @param Node $node
     * @param Request $request
     * @throws \Exception
     */
    public function updateTree(Node $node, Request $request)
    {
        if (empty($this->tree)) {
            $node->setId(1);
            $node->setParentId('');
            $this->tree[$node->getKeyMap()] = $node->getElement();
        } else {
            $nodeId = count($this->tree) + 1;
            $node->setId($nodeId);

            if ($node->getParentId() == 0) {
                $node->setParentId('');
                $this->tree[$node->getKeyMap()] = $node->getElement();
            }else{
                $key = $request->post('key');

                if(empty($key)){
                    throw new \Exception("Key does not exist");
                }
                $this->updateParentNode($key, $node->getElement());
            }
        }
    }

    /**
     * @param Request $request
     * @return Node
     * @throws \Exception
     */
    public function handleNode(Request $request)
    {
        $key = $request->post('key');

        if(is_null($key)){
            throw new \Exception("Key does not exist");
        }

        $id = 0;
        $parentId = 0;

        if (!empty($key)) {
            $parentNode = $this->handleKeyMap($key);
        }

        if(!empty($parentNode)){
            $parentId = $parentNode['id'];
        }

        $value = $request->post('elem');
        $node = new Node($id, $parentId, $value);

        return $node;
    }

    /**
     * @param $keyMap
     * @return array
     */
    private function handleKeyMap($keyMap)
    {
        if (array_key_exists($keyMap, $this->tree)) {
            return $this->tree[$keyMap];
        } else {
            foreach ($this->tree as $key => $subarr) {
                if (is_array($subarr)) {
                    $ret = $this->handleKeyMap($keyMap);
                    if ($ret) {
                        return $ret;
                    }
                }
            }
        }
    }

    /**
     * @param $keyMap
     * @param $nodeArray
     */
    private function updateParentNode($keyMap, $nodeArray){
        if (array_key_exists($keyMap, $this->tree)) {
            array_push($this->tree[$keyMap]['children'], $nodeArray);
        } else {
            foreach ($this->tree as $key => $subarr) {
                if (is_array($subarr)) {
                    $ret = updateParentNode($keyMap, $nodeArray);
                    if ($ret) {
                        array_push($ret['children'], $nodeArray);
                    }
                }
            }
        }
    }
}