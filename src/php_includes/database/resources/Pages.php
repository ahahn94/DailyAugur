<?php
/**
 * Created by PhpStorm.
 * User: ahahn94
 * Date: 25.11.18
 * Time: 19:42
 */

include "Resource.php";

class Pages implements Resource
{

    public static function read_dataset($id)
    {
        $connection = Connection::get_instance();
        $statement = $connection->prepare("SELECT * FROM Pages WHERE page_id = ?;");
        $statement->execute(array($id));
        if ($statement->rowCount() != 0) {
            return $statement->fetch(PDO::FETCH_ASSOC);
        } else {
            return null;
        }
    }

    public static function write_dataset($id, $data)
    {
        // TODO: Implement write_data() method.
    }

    public static function read_datasets()
    {
        $connection = Connection::get_instance();
        $statement = $connection->prepare("SELECT * FROM Pages order by page_id;");
        $statement->execute();
        if ($statement->rowCount() != 0) {
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        } else {
            return null;
        }
    }

    public static function count_datasets()
    {
        $connection = Connection::get_instance();
        $statement = $connection->prepare("SELECT COUNT(*) FROM Pages");
        $statement->execute();
        if ($statement->rowCount() != 0) {
            return $statement->fetch(PDO::FETCH_ASSOC)["COUNT(*)"];
        } else {
            return 0;
        }
    }
}