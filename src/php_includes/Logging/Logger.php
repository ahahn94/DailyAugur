<?php
/**
 * Created by ahahn94
 * on 18.02.19
 */

/**
 * Class Logger
 * Handles logging of errors, warnings and information.
 */
class Logger
{
    private static $log_path = "/log.txt";

    // Line headers.
    private static $error_header = "[ERRO] ";
    private static $warning_header = "[WARN] ";
    private static $information_header = "[INFO] ";

    /**
     * Write a new error message to the log file.
     * Header and timestamp are automatically prepended.
     * Newline is automatically appended.
     * @param $message string Message to append to the log file.
     */
    public static function logError($message)
    {
        error_log(self::$error_header . self::getTimestamp() . " " . $message . "\n", 3, $_SERVER["DOCUMENT_ROOT"] . self::$log_path);
    }

    /**
     * Write a new warning message to the log file.
     * Header and timestamp are automatically prepended.
     * Newline is automatically appended.
     * @param $message string Message to append to the log file.
     */
    public static function logWarning($message)
    {
        error_log(self::$warning_header . self::getTimestamp() . " " . $message . "\n", 3, $_SERVER["DOCUMENT_ROOT"] . self::$log_path);
    }

    /**
     * Write a new information message to the log file.
     * Header and timestamp are automatically prepended.
     * Newline is automatically appended.
     * @param $message string Message to append to the log file.
     */
    public static function logInformation($message)
    {
        error_log(self::$information_header . self::getTimestamp() . " " . $message . "\n", 3, $_SERVER["DOCUMENT_ROOT"] . self::$log_path);
    }

    private static function getTimestamp(){
        return date("Y-m-d H:i:s");
    }
}