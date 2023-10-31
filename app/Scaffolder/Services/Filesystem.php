<?php

namespace App\Scaffolder\Services;

class Filesystem
{
    public $files = [];

    public static function make()
    {
        return new static;
    }

    public function getDirContents($dir, &$results = [])
    {
        $files = scandir($dir);

        foreach ($files as $key => $value) {
            $path = realpath($dir.DIRECTORY_SEPARATOR.$value);
            if (! is_dir($path)) {
                $results[] = $path;
                $this->files[] = $path;
            } elseif ($value != '.' && $value != '..') {
                $this->getDirContents($path, $results);
                $results[] = $path;
            }
        }

        return $results;
    }

    public function fileForceContents($filename, $data, $flags = 0)
    {
        if (! is_dir(dirname($filename))) {
            mkdir(dirname($filename).'/', 0775, true);
        }

        return file_put_contents($filename, $data, $flags);
    }
}
