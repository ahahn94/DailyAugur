<?php
/**
 * Created by ahahn94
 * on 25.11.18
 */

require_once "Initialization.php";

class Connection
{

    // Database config.
    private static $DB_SERVER_IP = "database";
    private static $DB_USER_NAME = "DailyAugur";
    private static $DB_USER_PASSWORD = "keinsicherespasswort";
    private static $DB_NAME = "DailyAugur";

    private static $instance = NULL;

    public static function get_instance()
    {
        if (!isset(self::$instance)) {
            self::$instance = self::create_instance();
            Initialization::check_initialization();
        }
        return self::$instance;
    }

    private static function create_instance()
    {
        $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
        $pdo_options[PDO::MYSQL_ATTR_INIT_COMMAND] = "Set Names utf8";
        return new PDO("mysql:host=" . self::$DB_SERVER_IP . ";dbname=" .
            self::$DB_NAME, self::$DB_USER_NAME, self::$DB_USER_PASSWORD, $pdo_options);
    }

}