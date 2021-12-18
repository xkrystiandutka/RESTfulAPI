<?php 

    define('DS') ? null : define('DS', DIRECTORY_SEPARATOR);
    define('SITE_ROOT') ? null : define('SITE_ROOT', DS . 'wamp64'.DS.'www'.DS.'RESTFULAPI');
    define('INC_PATH') ? null : define('INC_PATH', SITE_ROOT.DS.'includes');
    define('CORE_PATH') ? null : define('CORE_PATH', SITE_ROOT.DS.'core');
 
    require_once(INC_PATH.DS."config.php");

    require_once(CORE_PATH.DS."post.php");

?>