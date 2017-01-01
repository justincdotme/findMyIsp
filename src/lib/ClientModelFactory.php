<?php namespace findMyIsp\lib;

use findMyIsp\model\Client;

class ClientModelFactory {

    protected $_curl;
    protected $_clientIp;

    public function __construct(DataAccessInterface $curl)
    {
        $this->_curl = $curl;
        $this->_clientIp = $_SERVER['REMOTE_ADDR'];
    }

    /**
     * Create a new Client model.
     *
     * @return mixed
     */
    public function make()
    {
        $curlParams = [
            CURLOPT_URL => "http://ipinfo.io/" . $this->_clientIp . "/json",
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_HEADER => 0
        ];

        $data = $this->_curl->getData($curlParams);

        return new Client($data);
    }
}