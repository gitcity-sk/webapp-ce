<?php

namespace App\Services;

class Workhorse
{
    protected $server;

    protected $data;

    protected const UNICORN_SOCKET = 'tcp://localhost:8801';

    /**
     * SocketClient constructor.
     * @param $socket
     */
    public function __construct($socket = null)
    {
        if ($socket == null) {
            $socket = static::UNICORN_SOCKET;
        }
        $this->_setSocket($socket);
    }

    /**
     * @param $socket
     */
    protected function _setSocket($socket)
    {
        $this->server = stream_socket_client($socket, $errno, $errstr, 30);

        if (!$this->server) {
            echo "$errstr ($errno)";
        }
    }

    /**
     * @param null $action
     * @return $this
     */
    public function setAction($action = null)
    {
        $this->data['action'] = $action;

        return $this;
    }

    /**
     * @param null $data
     * @return $this
     */
    public function setData($data = null)
    {
        $this->data['data'] = $data;

        return $this;
    }

    /**
     * @param $data
     * @return null|string
     */
    public function run($data = null)
    {
        if (!$this->server) {
            return false;
        }

        $data != null ? $this->data = $data : null;

        $out = json_encode($this->data);
        fwrite($this->server, $out);

        return $this->_read();
    }

    /**
     * @return null|string
     */
    protected function _read()
    {
        $response = null;
        while (!feof($this->server)) {
            $response .= fgets($this->server, 1024 * 8);
        }

        return $response;
    }
}
