<?php

namespace App\Scaffolder\Services\ReplaceHandlers;

class HandlePostForm implements IHandler
{
    private array $replace = [];

    public function __construct(
        protected $patternSingular,
        protected $patternPolural,
        protected $componentName,
    )
    {

    }

    public function handle($fileName)
    {
        if (preg_match('/' . ucfirst($this->patternSingular) . 'Form/i', $fileName)) {
            $output = "[\n";
            $arr = [];
            foreach (request('fields') as $field) {
                switch ($field['fieldType']) {
                    case 'text':
                        $arr[] = $this->sampleText($field['name']);
                        break;
                    case 'select':
                        $arr[] = $this->sampleSelect($field['name']);
                        break;
                    case 'id':
                        $arr[] = $this->sampleId($field['name']);
                        break;
                    case 'remote_select':
                        $arr[] = $this->sampleRemoteSelect($field['name']);
                        break;
                    default:
                        $arr[] = $this->sampleText($field['name']);
                        break;
                }
            }
            $output = $output . implode(",\n", $arr) . "\n]";

            $this->replace = [
                '%form_fields%' => $output,
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

    private function sampleText($fieldName)
    {
        return "Text::make('$fieldName', trans('fields.$fieldName'))";
    }

    private function sampleId($fieldName)
    {
        return "ID::make('$fieldName', trans('fields.$fieldName'))";
    }

    private function sampleSelect($fieldName)
    {
        $ucFieldName = ucfirst($fieldName);
        return "Select::make('status', trans('fields.$fieldName'))
                ->enum({$ucFieldName}Status::class)";
    }

    private function sampleRemoteSelect($fieldName)
    {
        return "RemoteSelect::make('$fieldName', trans('fields.$fieldName'))
                ->url(\$this->getAuthorSearchUrl())";
    }
}
