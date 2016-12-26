<?php

namespace Core;


class FileDataStore implements \DataStore
{
    private $resourceName = 'Core/data.json';

    /**
     * FileDataStore constructor.
     */
    public function __construct()
    {
    }

    public function update($data)
    {
        $fp = fopen($this->resourceName, 'w');
        fwrite($fp, $data);
        fclose($fp);
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
        $handle = fopen($this->resourceName, "r");
        $contents = [];
        if (filesize($this->resourceName) > 0) {
            $contents = fread($handle, filesize($this->resourceName));
            $contents = json_decode($contents, true);
        }
        fclose($handle);
        return $contents;
    }
}