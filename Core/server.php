<?php



exit();

require_once "class.database.php";

class Node
{
    public $id, $data, $childs = array();

    public function __construct($id, $parent_id, $name)
    {
        $this->id = $id;
        $this->parent_id = $parent_id;
        $this->name = $name;
    }
}


class Tree
{
    private $refs = array(), $tree = array();

    function __construct($tree)
    {
        $this->tree[] = $tree;
        $this->refs[0] = &$tree;
    }

    function appendChild($id, $parent_id, $data)
    {
        if (isset($this->refs[$parent_id])) {
            if (isset($this->refs[$id])) {
                echo "Элемент с id = $id уже имеется.<br />";
            } else {
                $ref = $this->refs[$parent_id][0];
                $node = new Node($id, $parent_id, $data);
                
                $ref->childs[] = $node;
                $this->refs[$id] = &$node;
            }
        } else {
            echo "Элемента с id = $parent_id нет.<br />";
        }
    }

    function get()
    {
        return $this->tree;
    }
}

$db = Database::getInstance();
$mysqli = $db->getConnection();

if ($_POST) {
    $sql_query = "SELECT tree FROM tree_elems WHERE id=1";
    $result = $mysqli->query($sql_query);
    $row = $result->fetch_row();
    $tree = json_decode($row[0], false);

    $t = new Tree($tree);
    $name = $_POST["elem"];
    $json = array();

    $t->appendChild(1, 0, $name);

    $res = json_encode($t->get());
    $sql_query = "UPDATE tree_elems SET tree='$res' WHERE id=1";
    $result = $mysqli->query($sql_query);
}

if ($_POST['tree'] == true) {
    $sql_query = "SELECT tree FROM tree_elems";
    $result = $mysqli->query($sql_query);

    return $result;
}



