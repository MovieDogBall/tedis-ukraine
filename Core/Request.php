<?php

namespace Core;

class Request
{
    /**
     * @var
     */
    private $get;

    /**
     * @var
     */
    private $post;

    /**
     * @var
     */
    private $server;

    /**
     * @var
     */
    private $files;

    /**
     * @var
     */
    private $servers;

    /** @var $cookies */
    private $cookies;

    /**
     * Request constructor.
     * @param $get
     * @param $post
     * @param $server
     * @param $files
     * @param $server
     * @param $cookies
     */
    public function __construct($get, $post, $server, $files, $server, $cookies)
    {
        $this->get = $get;
        $this->post = $post;
        $this->servers = $server;
        $this->files = $files;
        $this->server = $server;
        $this->cookies = $cookies;
    }

    /**
     * @param $key
     * @return mixed | null
     */
    public function get($key)
    {
        return (isset($this->get[$key])) ? $this->get[$key] : null;
    }

    /**
     * @param $key
     * @return mixed|null
     */
    public function post($key)
    {
        if(!isset($this->post[$key])){
            return null;
        }
        return $this->post[$key];
    }

    /**
     * @param $key
     * @param null $defaultValue
     * @return mixed
     */
    public function server($key, $defaultValue = null)
    {
        return $this->server->get($key, $defaultValue);
    }

    /**
     * @return mixed
     */
    public function getMethod()
    {
        return $this->server->get('REQUEST_METHOD');
    }
}