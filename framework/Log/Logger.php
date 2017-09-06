<?php

namespace Framework\Log;

class Logger
{
    private static $filePath = "/";
    private static $fileName = "text.txt";

    public static function log($txt)
    {
        $txt = $txt . "\\n";
        $file = self::checkOrCreateFile();
        fwrite($file, $txt);
        fclose($myfile);
    }

    public static function checkOrCreateFile()
    {
        return fopen(self::$filePath . self::$fileName, "w") or die("Unable to open log file.");
    }
}
