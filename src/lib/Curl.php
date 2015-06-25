<?php namespace findMyIsp\lib;

class Curl implements DataAccessInterface {

    public function __construct()
    {

    }

    /**
     * Curl a remote endpoint.
     *
     * @param $endpoint
     * @param array $params
     * @return bool
     */
    public function getData(array $params)
    {
        $handle = curl_init();

        $this->setCurlOptions($handle, $params);

        $output = curl_exec($handle);
        curl_close($handle);
        if($output === false)
        {
            return false;
        }
        return json_decode($output);
    }

    /**
     * Set Curl options.
     *
     * @param array $options
     */
    protected function setCurlOptions($handle, array $options)
    {
        foreach($options as $option => $param)
        {
            curl_setopt($handle, $option, $param);
        }
    }
}