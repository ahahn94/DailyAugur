<?php
/**
 * Created by ahahn94
 * on 25.11.18
 */

require_once __DIR__ . "/../../Logging/Logger.php";
require_once __DIR__ . "/../Connection.php";

interface Resource
{
    public static function read_dataset($id);
    public static function read_datasets();
    public static function write_dataset($data);
    public static function count_datasets();
    public static function get_ids();
    public static function get_next_id();
    public static function delete_dataset($id);
}