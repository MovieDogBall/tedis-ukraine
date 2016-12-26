<?php

interface DataStore
{
    public function get();

    public function update($data);

    public function insert($data);

    public function delete($data);
}