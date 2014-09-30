<?php

//Denied straight access
define('VIZITKI', TRUE);

// include file configurations
require_once '../config.php';

// CONTROLLER
require_once 'controller/controller.php';

// HEADER
include VIEW.'header.php';

// CONTENT
include VIEW.$view.'.php';

// FOOTER
include VIEW.'footer.php';