<?php
/**
 * Constants
 *
 * @author Virgil-Adrian Teaca - virgil@giulianaeassociati.com
 * @version 3.0
 */

/**
 * Setup the Config API Mode.
 * For using the 'database' mode, you need to have a database, with a table generated by 'scripts/nova_options'
 */
define('CONFIG_STORE', 'files'); // Supported: "files", "database"

/**
 * define the database config
 */

define('DB_TYPE', 'mysql');
define('DB_HOST', 'localhost');
define('DB_NAME', 'momentum_test');
define('DB_USER', 'root');
define('DB_PASS', '');
define('PREFIX', 'momentum_');


define('SESSION_PREFIX', 'momentum_');
