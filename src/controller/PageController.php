<?php namespace findMyIsp\controller;

use findMyIsp\lib\ClientModelFactory;
use findMyIsp\lib\Curl;
use findMyIsp\lib\IspModelFactory;
use findMyIsp\lib\ModelFactory;
use findMyIsp\lib\Request;
use findMyIsp\model\Client;
use findMyIsp\model\Isp;
use findMyIsp\lib\View;
use findMyIsp\lib\Controller;

class PageController extends Controller {

    protected $_view;
    protected $_client;
    protected $_isp;
    protected $_request;
    protected $_curl;

    public function __construct()
    {
        $this->_view = new View;
        $this->_curl = new Curl;
        $this->_client = (new ClientModelFactory($this->_curl))->make();
        $this->_request = new Request;
        $this->_isp = (new IspModelFactory($this->_curl, $this->_client->getLocation()))->make();
    }

    /**
     * Display the index page for the application.
     * Include client IP, geographic location and ISP name.
     *
     * @return mixed
     */
    public function index()
    {
        $view = 'home';

        $data['clientIp'] = $this->_client->getIp();
        $data['clientIsp'] = $this->_client->getIsp();

        return $this->_view->make($view, $data);
    }

    /**
     * List nearby ISPs.
     * Returns JSON (if Ajax) or HTML.
     *
     * @return mixed
     */
    public function show()
    {
        if($this->_request->isPost())
        {
            if($this->_request->isAjax())
            {
                $location = filter_input(INPUT_POST, 'location' ,FILTER_SANITIZE_STRING);
                if(!is_null($location))
                {
                    $this->_isp = (new IspModelFactory($this->_curl, $location))->make();
                }
                $list = $this->_isp->getIspJsonList();
                return $this->jsonOut($list);
            }
            $view = 'list-no-js';

            $data['clientIp'] = $this->_client->getIp();
            $data['clientIsp'] = $this->_client->getIsp();
            $data['list'] = $this->_isp->getIspList();

            return $this->_view->make($view, $data);
        }
        return false;
    }
}