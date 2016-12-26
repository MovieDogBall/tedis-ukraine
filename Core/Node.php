<?php

namespace Core;

class Node
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var int
     */
    private $parentId;

    /**
     * @var string
     */
    private $name;

    /**
     * @var array
     */
    private $children;


    /**
     * Node constructor.
     * @param $id
     * @param $parentId
     * @param string $name
     * @param array $children
     */
    public function __construct($id = 0, $parentId = 0, $name = 'element', $children = [])
    {
        $this->id = $id;
        $this->parentId = $parentId;
        $this->name = $name;
        $this->children = $children;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function getParentId()
    {
        return $this->parentId;
    }

    public function getElement()
    {
        return [
            'id' => $this->getId(),
            'parent' => $this->getParentId(),
            'name' => $this->getName(),
            'keyMap' => $this->getKeyMap(),
            'children' => $this->getChildren()
        ];
    }

    /**
     * @return string
     */
    public function getKeyMap()
    {
        return $this->getParentId() . ':' . $this->getId();
    }

    /**
     * @param $nodeId
     */
    public function setId($nodeId)
    {
        $this->id = $nodeId;
    }

    /**
     * @param $id
     */
    public function setParentId($id)
    {
        $this->parentId = $id;
    }

    /**
     * @return array
     */
    private function getChildren()
    {
        return $this->children;
    }

}