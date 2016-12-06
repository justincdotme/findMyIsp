<?php

//Name the session.
session_name('nearMeSession');
//Start the session.
session_start();

//Require the Composer autoloader.
require '../vendor/autoload.php';

//Require the app config file.
require '../src/config/Config.php';

//Require the router.
require '../src/router.php';