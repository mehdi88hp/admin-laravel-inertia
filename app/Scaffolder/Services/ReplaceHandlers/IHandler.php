<?php

namespace App\Scaffolder\Services\ReplaceHandlers;

interface IHandler
{
    public function __construct($componentName, $patternSingular, $patternPolural);

    public function handle($fileName);

    public function newContent($content);

    public function newPath($content);
}
