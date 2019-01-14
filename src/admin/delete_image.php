<?php
/**
 * Created by ahahn94
 * on 08.01.19
 */

/*
 * Script to delete images from cache and database.
 */

require_once "../php_includes/cache/ImageCache.php";

$image_id = $_POST["image_id"] ? $_POST["image_id"] : null;

if (($image_id != null)){
    ImageCache::deleteImage($image_id);
}