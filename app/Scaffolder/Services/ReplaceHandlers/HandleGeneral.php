<?php

namespace App\Scaffolder\Services\ReplaceHandlers;

use Illuminate\Support\Str;

class HandleGeneral implements IHandler
{
    private array $replace;

    public function __construct(
        protected $patternSingular,
        protected $patternPolural,
        protected $componentName,
    ) {

    }

    public function handle($fileName)
    {
        $this->replace = [
            ucfirst($this->patternSingular) => ucfirst($this->componentName),
            $this->patternSingular => $this->componentName,
            ucfirst($this->patternPolural) => ucfirst(Str::plural($this->componentName)),
            $this->patternPolural => Str::plural($this->componentName),
        ];

        return $this;
    }

    public function newContent($content)
    {
        return str_replace(array_keys($this->replace), array_values($this->replace), $content);
    }

    public function newPath($path)
    {
        $replace = $this->replace;
        $replace['.stub'] = '.php';

        return str_replace(array_keys($replace), array_values($replace), $path);
    }
}
