<?php namespace findMyIsp;

use findMyIsp\controller\PageController;

/**
 * The homepage has 2 possible URIs: / and /index.php
 */
$homePage = ($_SERVER['REQUEST_URI'] === '/' || $_SERVER['REQUEST_URI'] === '/index.php') ? true : false;

/**
 * GET the homepage
 */
if($_SERVER['REQUEST_METHOD'] === 'GET')
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
if($_SERVER['REQUEST_METHOD'] === 'POST')
{
    if($homePage)
    {
        $controller = new PageController();
        $controller->show();
    }
}