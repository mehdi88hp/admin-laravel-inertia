<?php

namespace App\Scaffolder\Services\ReplaceHandlers;

use Symfony\Component\VarExporter\VarExporter;

class HandleStoreRequest implements IHandler
{
    private array $replace = [];

    public function __construct(
        protected $patternSingular,
        protected $patternPolural,
        protected $componentName,
    ) {

    }

    public function handle($fileName)
    {
        if (preg_match('/Store'.ucfirst($this->patternSingular).'Request/i', $fileName)) {
            $output = [];
            foreach (request('fields') as $field) {
                $output[$field['name']] = [$field['required'] ? 'required' : 'optional'];
            }

            $this->replace = [
                '%store_rules%' => VarExporter::export($output),
            ];
        }

        return $this;
    }

    public function newContent($content)
    {
        return str_replace(array_keys($this->replace), array_values($this->replace), $content);
    }

    public function newPath($path)
    {
        return null;
    }
}
