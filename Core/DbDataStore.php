<?php

namespace Core;


class DbDataStore implements \DataStore
{
    /**
     * FileDataStore constructor.
     */
    public function __construct($db)
    {
        $this->db = $db;
    }

    public function update($data)
    {
        $sql_query = "UPDATE tree_elems SET tree='$data' WHERE id=1";
        $this->db->query($sql_query);
    }

    public function insert($data)
    {
        // TODO: Implement insert() method.
    }

    public function delete($data)
    {
        // TODO: Implement delete() method.
    }

    /**
     * @return array
     */
    public function get()
    {
        $sql_query = "SELECT tree FROM tree_elems WHERE id=1";
        $result = $this->db->query($sql_query);
        $contents = $result->fetch_row();

        $contents = json_decode($contents[0], true);

        return $contents;
    }
}