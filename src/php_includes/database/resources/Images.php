<?php
/**
 * Created by ahahn94
 * on 08.01.19
 */

require_once "Resource.php";

/**
 * Class Images handles the database table Images.
 */
class Images implements Resource
{

    /**
     * Read a single dataset.
     * @param $id int image_id of the Image.
     * @return mixed|null Dataset if successful, else null.
     */
    public static function read_dataset($id)
    {
        $connection = Connection::get_instance();
        $statement = $connection->prepare("SELECT * FROM Images WHERE image_id = ?;");
        $statement->execute(array($id));
        if ($statement->rowCount() != 0) {
            return $statement->fetch(PDO::FETCH_ASSOC);
        } else {
            return null;
        }
    }

    /**
     * Read all datasets.
     * @return array|null Array of datasets if successful, else null.
     */
    public static function read_datasets()
    {
        $connection = Connection::get_instance();
        $statement = $connection->prepare("SELECT * FROM Images ORDER BY image_id DESC;");
        $statement->execute();
        if ($statement->rowCount() != 0) {
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        } else {
            return null;
        }
    }

    /**
     * Write single dataset to database.
     * @param $data array Image data.
     * @return bool|string -1 if image_id is not set, else sql error code. 0 if ok.
     */
    public static function write_dataset($data)
    {
        $image_id = $data["image_id"] ? $data["image_id"] : -1;
        if ($image_id != -1) {
            // Images will never be updated.
            $command = "INSERT INTO Images (image_id, name, path) VALUES (:image_id, :name, :path)";
            $string = $command;
            $string = str_replace(":image_id", $data["image_id"], $string);
            $string = str_replace(":name", $data["name"], $string);
            $string = str_replace(":path", $data["path"], $string);
            $connection = Connection::get_instance();
            $statement = $connection->prepare($command);
            $statement->execute($data);
            return $statement->errorCode();
        }
        return -1;
    }

    /**
     * Get count of all datasets.
     * @return int Number of datasets if successful, else 0.
     */
    public static function count_datasets()
    {
        $connection = Connection::get_instance();
        $statement = $connection->prepare("SELECT COUNT(*) FROM Images");
        $statement->execute();
        if ($statement->rowCount() != 0) {
            return $statement->fetch(PDO::FETCH_ASSOC)["COUNT(*)"];
        } else {
            return 0;
        }
    }

    /**
     * Get image_ids of all images.
     * @return array|null Array of all images image_ids if successful, else null.
     */
    public static function get_ids()
    {
        $connection = Connection::get_instance();
        $statement = $connection->prepare("SELECT image_id FROM Images ORDER BY image_id;");
        $statement->execute();
        if ($statement->rowCount() != 0) {
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        } else {
            return null;
        }
    }

    /**
     * Get next available image_id for new dataset.
     * @return |null Next available image_id if successful, else null.
     */
    public static function get_next_id()
    {
        $connection = Connection::get_instance();
        $statement = $connection->prepare("SELECT AUTO_INCREMENT FROM information_schema.tables WHERE 
                                                           table_name = 'Images' AND table_schema = DATABASE( ) ;");
        $statement->execute();
        if ($statement->rowCount() != 0) {
            return $statement->fetch(PDO::FETCH_ASSOC)["AUTO_INCREMENT"];
        } else {
            return null;
        }
    }

    /**
     * Delete a dataset by image_id.
     * @param $id int image_id of the image to delete.
     * @return string SQL error code. 0 if ok.
     */
    public static function delete_dataset($id)
    {
        $command = "DELETE FROM Images WHERE image_id = :image_id";
        $connection = Connection::get_instance();
        $statement = $connection->prepare($command);
        $statement->execute(array("image_id" => $id));
        return $statement->errorCode();
    }
}