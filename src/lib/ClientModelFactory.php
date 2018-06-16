<?php namespace findMyIsp\lib;

use findMyIsp\model\Client;

class ClientModelFactory {

    protected $_curl;
    protected $_request;

    public function __construct(DataAccessInterface $curl, Request $request)
    {
        $this->_curl = $curl;
        $this->_request = $request;
    }

    /**
     * Create a new Client model.
     *
     * @return mixed
     */
    public function make()
    {
        $curlParams = [
            CURLOPT_URL => "http://ipinfo.io/" . $this->_request->getClientIp() . "/json",
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_HEADER => 0
        ];

        return new Client($this->_curl->getData($curlParams));
    }
}