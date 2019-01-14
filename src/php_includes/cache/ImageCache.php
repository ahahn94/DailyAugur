<?php
/**
 * Created by ahahn94
 * on 08.01.19
 */

require_once __DIR__ . "/../database/resources/Images.php";

/**
 * Class ImageCache.
 * Handles caching of images.
 */
class ImageCache
{
    // Path to the image cache directory.
    private static $image_cache_path = "/cache/images/";

    /**
     * Check if an image name is already in the cache folder.
     * @param $image_name Name of the image.
     * @return bool Result of file_exists on $image_name. True if file exists.
     */
    public static function imageOnCache($image_name)
    {
        return file_exists($_SERVER["DOCUMENT_ROOT"] . self::$image_cache_path . basename($image_name));
    }

    /**
     * Save a base64 encoded image to the cache.
     * @param $image_name Name of the image.
     * @param $base64_string Base64 encoded string representing the files binary data.
     * @return int|string 0 if ok, -1 if already on cache, SQL error code (>0) if database error.
     */
    public static function saveImage($image_name, $base64_string)
    {
        if (!self::imageOnCache($image_name)) {
            $image_id = Images::get_next_id();
            $path = self::getImageCachePath() . rawurlencode($image_name);
            $result = Images::write_dataset(array("image_id" => $image_id, "name" => $image_name, "path" => $path));
            if ($result == 0) {
                $image_file_path = $_SERVER["DOCUMENT_ROOT"] . self::$image_cache_path . basename($image_name);
                $file_content = base64_decode(explode(",", $base64_string)[1]);
                $image_file = fopen($image_file_path, 'w+');
                fwrite($image_file, $file_content);
                fclose($image_file);
                return 0;
            } else {
                return $result;
            }
        }
        return -1;
    }

    /**
     * Delete an image from the cache.
     * @param $image_id image_id of the image to delete.
     */
    public static function deleteImage($image_id)
    {
        $image = Images::read_dataset($image_id);
        if ($image != null){
            $image_name = $image["name"];
            $image_file_path = $_SERVER["DOCUMENT_ROOT"] . self::$image_cache_path . $image_name;
            if (file_exists($image_file_path)) {
                unlink($image_file_path);
                Images::delete_dataset($image_id);
            }
        }
    }

    public static function getImageCachePath(): string
    {
        return self::$image_cache_path;
    }
}