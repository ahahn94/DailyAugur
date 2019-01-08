<?php
/**
 * Created by ahahn94
 * on 25.11.18
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
        /*
        * date_published is the date of the initial publication.
        * date_last_modified is the date of the last modification to the published page.
        * date_saved is the date of the last modification of the saved content and title.
        */
        $connection->exec("
CREATE TABLE Pages (
  page_id                   INT PRIMARY KEY AUTO_INCREMENT,
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