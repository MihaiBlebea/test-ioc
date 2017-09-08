<?php

namespace Framework\Log;

use Exceptions;

class Logger
{
    private static $filePath =  __LOG_PATH__;
    private static $fileName = "text.txt";

    public static function test()
    {
        dd("test error");
    }

    public static function log($txt)
    {
        $date = date("Y-m-d");

        $txt = $txt . "\n";
        $file = self::checkOrCreateFile(self::$filePath . $date . "_" . self::$fileName);
        
        fwrite($file, $txt);
        fclose($file);
    }

    public static function checkOrCreateFile($file)
    {
        return fopen($file, "a");
    }
}
