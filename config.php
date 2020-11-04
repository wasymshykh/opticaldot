<?php

    define('DB_HOST', "localhost");
    define('DB_NAME', "opticaldot_db");
    define('DB_USER', "root");
    define('DB_PASS', "");
    define('URL', "http://opticaldot.test");
    define('ENV', 'development');
    define('DEBUG_MODE', ENV === "development" ? true : false);

    define('HOUR_DIFFERENCE_DB', 3); // Ideally should be 0

?>