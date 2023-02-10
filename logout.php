<?php

require __DIR__. '/app/Db/Database.php';
require __DIR__. '/app/Entity/Usuario.php';
require __DIR__. '/app/Session/Login.php';

use \App\Session\Login;

Login::logout();

?>
