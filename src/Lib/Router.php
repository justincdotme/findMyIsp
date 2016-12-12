<?php namespace nearMe\Lib;

use nearMe\controller\PageController;

class Router {
    public function route()
    {
        //TODO - Implement a much more robust routing solution
        if (in_array($_SERVER['REQUEST_URI'], ['/', '/index.php'])) {
            $controller = new PageController();
            $request = new Request();
            if ($request->isGet()) {
                //GET something

            } else if ($request->isPost()) {
                //POST something
            }
        }
    }
}
