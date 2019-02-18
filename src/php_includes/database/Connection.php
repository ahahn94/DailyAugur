<?php
/**
 * Created by ahahn94
 * on 25.11.18
 */

require_once __DIR__ . "/../Logging/Logger.php";
require_once "Initialization.php";

/**
 * Class Connection
 * Handles the database connection.
 */
class Connection
{

    // Database config.
    private static $DB_SERVER_IP = "database";
    private static $DB_USER_NAME = "DailyAugur";
    private static $DB_USER_PASSWORD = "keinsicherespasswort";
    private static $DB_NAME = "DailyAugur";

    private static $instance = NULL;

    /**
     * Get the PDO connection.
     * Establish connection and init database if necessary.
     * @return int|PDO|null PDO connection if successful, else -1.
     */
    public static function get_instance()
    {
        if (!isset(self::$instance)) {
            self::$instance = self::create_instance();
            if (self::$instance != null) {
                Initialization::check_initialization();
            } else {
                Logger::logError("Database connection could not be established! Check your credentials and connection settings.");
                return -1;
            }
        }
        return self::$instance;
    }

    /**
     * Create a new PDO connection.
     * @return PDO|null PDO connection if successful, else null.
     */
    private static function create_instance()
    {
        try {
            $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
            $pdo_options[PDO::MYSQL_ATTR_INIT_COMMAND] = "Set Names utf8";
            $pdo = new PDO("mysql:host=" . self::$DB_SERVER_IP . ";dbname=" .
                self::$DB_NAME, self::$DB_USER_NAME, self::$DB_USER_PASSWORD, $pdo_options);
            return $pdo;
        } catch (PDOException $exception) {
            Logger::logError($exception->getMessage());
            return null;
        }
    }

}