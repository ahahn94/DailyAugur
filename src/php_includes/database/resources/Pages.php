<?php
/**
 * Created by ahahn94
 * on 25.11.18
 */

require_once __DIR__ . "/../../Logging/Logger.php";
require_once "Resource.php";

/**
 * Class Pages handles the database table Pages.
 */
class Pages implements Resource
{

    /**
     * Read a single dataset.
     * @param $id int page_id of the Page.
     * @return mixed|null Dataset if successful, else null.
     */
    public static function read_dataset($id)
    {
        $connection = Connection::get_instance();
        if ($connection != -1) {
            $statement = $connection->prepare("SELECT * FROM Pages WHERE page_id = ?;");
            $statement->execute(array($id));
            if ($statement->rowCount() != 0) {
                return $statement->fetch(PDO::FETCH_ASSOC);
            } else {
                return null;
            }
        } else {
            Logger::logError("Reading page failed! Unable to obtain database connection.");
            return null;
        }
    }

    /**
     * Write single dataset to database.
     * Create new dataset if page_id does not exist,
     * else update dataset.
     * @param $data array Page data.
     * @return bool|string -1 if page_id is not set or no connection, else sql error code. 0 if ok.
     */
    public static function write_dataset($data)
    {
        $page_id = $data["page_id"] ? $data["page_id"] : -1;
        if ($page_id != -1) {
            // Prepare keys and mappings.
            $keys = array_keys($data);
            $mappings = array_map(function ($key) {
                return ":$key";
            }, $keys);
            $command = "";
            if (in_array(array("page_id" => $page_id), self::get_ids())) {
                // Already on the database -> update dataset.
                $assignments = implode(", ", array_map(function ($key) {
                    return "$key = :$key";
                }, $keys));
                $command = "UPDATE Pages SET $assignments WHERE page_id = :page_id;";
            } else {
                // Not on the database -> insert dataset.
                $command = "INSERT INTO Pages (" . implode(", ", $keys) . ") VALUES (" . implode(", ", $mappings) . ");";
            }
            $connection = Connection::get_instance();
            if ($connection != -1) {
                $statement = $connection->prepare($command);
                $statement->execute($data);
                $error_code = $statement->errorCode();
                if ($error_code != 0){
                    Logger::logError("Writing page failed! SQL error code " . $error_code);
                }
                return $error_code;
            } else {
                Logger::logError("Writing page failed! Unable to obtain database connection.");
                return -1;
            }
        }
        return -1;
    }

    /**
     * Read all datasets.
     * @return array|null Array of datasets if successful, else null.
     */
    public static function read_datasets()
    {
        $connection = Connection::get_instance();
        if ($connection != -1) {
            $statement = $connection->prepare("SELECT * FROM Pages ORDER BY page_id;");
            $statement->execute();
            if ($statement->rowCount() != 0) {
                return $statement->fetchAll(PDO::FETCH_ASSOC);
            } else {
                return null;
            }
        } else {
            Logger::logError("Reading pages failed! Unable to obtain database connection.");
            return null;
        }
    }

    /**
     * Get count of all datasets.
     * @return int Number of datasets if successful, null if no connection, else 0.
     */
    public static function count_datasets()
    {
        $connection = Connection::get_instance();
        if ($connection != -1) {
            $statement = $connection->prepare("SELECT COUNT(*) FROM Pages");
            $statement->execute();
            if ($statement->rowCount() != 0) {
                return $statement->fetch(PDO::FETCH_ASSOC)["COUNT(*)"];
            } else {
                return 0;
            }
        } else {
            Logger::logError("Counting pages failed! Unable to obtain database connection.");
            return null;
        }
    }

    /**
     * Get count of all published datasets.
     * @return int Number of datasets if successful, null if no connection, else 0.
     */
    public static function count_published_pages_datasets()
    {
        $connection = Connection::get_instance();
        if ($connection != -1) {
            $statement = $connection->prepare("SELECT COUNT(*) FROM Pages WHERE date_published != '0000-00-00 00:00:00'");
            $statement->execute();
            if ($statement->rowCount() != 0) {
                return $statement->fetch(PDO::FETCH_ASSOC)["COUNT(*)"];
            } else {
                return 0;
            }
        } else {
            Logger::logError("Counting published pages failed! Unable to obtain database connection.");
            return null;
        }
    }

    /**
     * Get page_ids of all pages.
     * @return array|null Array of all pages page_ids if successful, else null.
     */
    public static function get_ids()
    {
        $connection = Connection::get_instance();
        if ($connection != -1) {
            $statement = $connection->prepare("SELECT page_id FROM Pages ORDER BY page_id;");
            $statement->execute();
            if ($statement->rowCount() != 0) {
                return $statement->fetchAll(PDO::FETCH_ASSOC);
            } else {
                return null;
            }
        } else {
            Logger::logError("Reading page_ids failed! Unable to obtain database connection.");
            return null;
        }
    }

    /**
     * Get page_ids of all saved pages.
     * @return array|null Array of all saved pages page_ids if successful, else null.
     */
    public static function get_saved_pages_ids()
    {
        $connection = Connection::get_instance();
        if ($connection != -1) {
            $statement = $connection->prepare("SELECT page_id FROM Pages ORDER BY page_id;");
            $statement->execute();
            if ($statement->rowCount() != 0) {
                return $statement->fetchAll(PDO::FETCH_ASSOC);
            } else {
                return null;
            }
        } else {
            Logger::logError("Reading page_ids of saved pages failed! Unable to obtain database connection.");
            return null;
        }
    }

    /**
     * Get page_ids of all published pages.
     * @return array|null Array of all published pages page_ids if successful, else null.
     */
    public static function get_published_pages_ids()
    {
        $connection = Connection::get_instance();
        if ($connection != -1) {
            $statement = $connection->prepare("SELECT page_id FROM Pages WHERE date_published != '0000-00-00 00:00:00' ORDER BY page_id;");
            $statement->execute();
            if ($statement->rowCount() != 0) {
                return $statement->fetchAll(PDO::FETCH_ASSOC);
            } else {
                return null;
            }
        } else {
            Logger::logError("Reading page_ids of published pages failed! Unable to obtain database connection.");
            return null;
        }
    }

    /**
     * Get next available page_id for new dataset.
     * @return |null Next available page_id if successful, else null.
     */
    public static function get_next_id()
    {
        $connection = Connection::get_instance();
        if ($connection != -1) {
            $statement = $connection->prepare("SELECT AUTO_INCREMENT FROM information_schema.tables WHERE 
                                                           table_name = 'Pages' AND table_schema = DATABASE( ) ;");
            $statement->execute();
            if ($statement->rowCount() != 0) {
                return $statement->fetch(PDO::FETCH_ASSOC)["AUTO_INCREMENT"];
            } else {
                return null;
            }
        } else {
            Logger::logError("Reading next page_id for autoincrement failed! Unable to obtain database connection.");
            return null;
        }
    }

    /**
     * Delete a dataset by page_id.
     * @param $id int page_id of the page to delete.
     * @return string SQL error code. 0 if ok. -1 if no connection.
     */
    public static function delete_dataset($id)
    {
        $command = "DELETE FROM Pages WHERE page_id = :page_id";
        $connection = Connection::get_instance();
        if ($connection != -1) {
            $statement = $connection->prepare($command);
            $statement->execute(array("page_id" => $id));
            $error_code = $statement->errorCode();
            if ($error_code != 0){
                Logger::logError("Deleting page failed! SQL error code " . $error_code);
            }
            return $error_code;
        } else {
            Logger::logError("Deleting page failed! Unable to obtain database connection.");
            return -1;
        }
    }

}