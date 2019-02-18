<?php
/**
 * Created by ahahn94
 * on 08.01.19
 */

require_once __DIR__ . "/../Logging/Logger.php";
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
     * @return bool Result of file_exists on $image_name. True if file exists. -1 if no write access.
     */
    public static function imageOnCache($image_name)
    {
        return file_exists($_SERVER["DOCUMENT_ROOT"] . self::$image_cache_path . basename($image_name));
    }

    /**
     * Save a base64 encoded image to the cache.
     * @param $image_name Name of the image.
     * @param $base64_string Base64 encoded string representing the files binary data.
     * @return int|string 0 if ok, -1 if already on cache or write error, SQL error code (>0) if database error.
     */
    public static function saveImage($image_name, $base64_string)
    {
        if (self::cache_writable()) {
            if (!self::imageOnCache($image_name)) {
                $image_id = Images::get_next_id();
                if ($image_id !== null) {
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
            } else {
                Logger::logInformation("Image " . $image_name . " is already on the cache and thus has not been added again. If this is a new image, please change its filename.");
            }
        } else {
            Logger::logError("Writing image failed! Check the permissions on cache/images.");
        }
        return -1;
    }

    /**
     * Delete an image from the cache.
     * @param $image_id image_id of the image to delete.
     */
    public static function deleteImage($image_id)
    {
        if (self::cache_writable()) {
            $image = Images::read_dataset($image_id);
            if ($image != null) {
                $image_name = $image["name"];
                $image_file_path = $_SERVER["DOCUMENT_ROOT"] . self::$image_cache_path . $image_name;
                unlink($image_file_path);
                Images::delete_dataset($image_id);
            }
        } else {
            Logger::logError("Deleting image failed! Check the permissions on cache/images.");
        }
    }

    /**
     * Check if the web server has write permissions on the images cache.
     * @return bool true if write access, else false.
     */
    private static function cache_writable()
    {
        $test_file = fopen($_SERVER["DOCUMENT_ROOT"] . self::getImageCachePath() . ".test_permissions", "w+");
        if ($test_file === false) {
            Logger::logError("No write access to the images cache! Try running fix_permissions.sh to fix this.");
            return false;
        } else {
            return true;
        }
    }

    public static function getImageCachePath(): string
    {
        return self::$image_cache_path;
    }
}