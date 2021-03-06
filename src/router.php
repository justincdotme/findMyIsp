<?php namespace findMyIsp;

use findMyIsp\controller\PageController;
use findMyIsp\lib\Request;

$request = new Request;

/**
 * The homepage has 2 possible URIs: / and /index.php
 */
$homePage = ($_SERVER['REQUEST_URI'] === '/' || $_SERVER['REQUEST_URI'] === '/index.php') ? true : false;

/**
 * GET the homepage
 */
if($request->isGet())
{
    if($homePage)
    {
        $controller = new PageController();
        $controller->index();
    }
}
/**
 * Post to the homepage.
 */
if($request->isPost())
{
    if($homePage)
    {
        $controller = new PageController();
        $controller->show();
    }
}
