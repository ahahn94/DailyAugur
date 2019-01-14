<?php
/**
 * Created by ahahn94
 * on 08.01.19
 */

/*
 * Script to upload images to the cache.
 */

require_once "../php_includes/cache/ImageCache.php";

$name = $_POST["name"] ? $_POST["name"] : null;
$file = $_POST["file"] ? $_POST["file"] : null;

if (($name != null) && ($file != null)){
    return ImageCache::saveImage($name, $file);
}