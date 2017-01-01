<?php namespace nearMe\Lib;

/**
 * Class Response
 * @package nearMe\Lib
 */
class Response {

    /**
     * Set the header to application/json.
     * Echo the $output string as raw JSON.
     *
     * @param $output
     */
    public function jsonOut($output)
    {
        header('Content-Type: application/json');
        echo json_encode($output);
    }
}