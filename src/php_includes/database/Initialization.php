<?php
/**
 * Created by PhpStorm.
 * User: ahahn94
 * Date: 25.11.18
 * Time: 18:16
 */

/**
 * Class Initialization
 * Handle initialization of the database tables.
 * @package php_includes\database
 */
class Initialization
{


    /**
     * Check if database is properly initialized.
     */
    public static function check_initialization()
    {

        // Names of the tables that have to be in the database.
        $table_names = array("Pages");

        // Get table names from database.
        $connection = Connection::get_instance();
        $statement = $connection->prepare("SHOW TABLES FROM DailyAugur;");
        $statement->execute();
        if ($statement->rowCount() != 0) {
            $tables_in_database = $statement->fetchAll(PDO::FETCH_ASSOC);
            $tables_in_database = array_column($tables_in_database, "Tables_in_DailyAugur");
            // Check if table_names does not matches tables_in_database.
            if (!(count(array_intersect($table_names, $tables_in_database)) == count($table_names))) {
                self::initialize();
            }
        } else {
            self::initialize();
        }
    }

    /**
     * Initialize database tables.
     */
    private static function initialize()
    {
        $connection = Connection::get_instance();
        $connection->exec("
CREATE TABLE Pages (
  page_id                   INT PRIMARY KEY,
  title                     TEXT,
  published_content         TEXT,
  saved_title               TEXT,
  saved_content             TEXT,
  date_created              DATETIME,
  date_published            DATETIME DEFAULT NULL,
  date_last_modified        DATETIME,
  date_saved                DATETIME
);");
    }

}