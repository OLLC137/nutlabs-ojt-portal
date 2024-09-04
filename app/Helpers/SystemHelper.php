<?php

namespace App\Helpers;

class SystemHelper
{
    public static function includeFilesInFolder(string $folder)
    {
        $files = array_values(array_diff(scandir($folder), array('.', '..')));
        foreach ($files as $file) {
            require sprintf("%s%s", $folder, $file);
        }
    }
}
