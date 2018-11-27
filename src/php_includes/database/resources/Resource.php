<?php
/**
 * Created by PhpStorm.
 * User: ahahn94
 * Date: 25.11.18
 * Time: 19:42
 */

require_once __DIR__ . "/../Connection.php";

interface Resource
{
    public static function read_dataset($id);
    public static function read_datasets();
    public static function write_dataset($id, $data);
    public static function count_datasets();
}