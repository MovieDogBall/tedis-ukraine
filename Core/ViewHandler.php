<?php

namespace Core;

class ViewHandler
{
    /**
     * @var array
     */
    private $tree;

    /**
     * ViewHandler constructor.
     * @param array $tree
     */
    public function __construct(array $tree)
    {

        $this->tree = $tree;
    }

    public function getHtmlView()
    {
        return $this->generateHtml($this->tree);
    }

    /**
     * @param $tree
     * @return string
     */
    private function generateHtml($tree)
    {
        $subTree = "<ul class=\"list-group\">";

        foreach ($tree as $key => $value) {
            $subTree .= "<li class=\"list-group-item\">" . $value['name'];

            if($this->isChildrenExist($value)){
                $subTree .=  $this->generateHtml($value['children']) ;
            }

            $subTree .= "</li>";
        }

        $subTree .= "</ul>";
        return $subTree;
    }

    /**
     * @param $value
     * @return bool
     */
    private function isChildrenExist($value)
    {
        if(!empty($value['children']) && is_array($value['children']) && count($value['children']) > 0){
            return true;
        }

        return false;
    }

    /**
     * @return array
     */
    public function getTree()
    {
        return $this->tree;
    }

    /**
     * @param array $tree
     * @return $this
     */
    public function setTree($tree)
    {
        $this->tree = $tree;
        return $this;
    }
}