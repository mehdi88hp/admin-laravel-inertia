<?php

namespace App\Scaffolder\Services\ReplaceHandlers;

use Symfony\Component\VarExporter\VarExporter;

class HandleControllerTest implements IHandler
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
        if (preg_match('/' . ucfirst($this->patternPolural) . 'ControllerTest/i', $fileName)) {
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

            $output = implode(",\n", $arr) . ",";

            $this->replace = [
                '%test_controller_store_payload%' => $output,
                '%test_controller_update_payload%' => $output,
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
        return "'$fieldName'" . "=> \$this->faker->realText(40)";
    }

    private function sampleId($fieldName)
    {
        return "'$fieldName'" . "=>\$this->faker->randomNumber(4)";
    }

    private function sampleSelect($fieldName)
    {
        return "'$fieldName'" . "=>\$this->faker->randomNumber(1)";
    }

    private function sampleRemoteSelect($fieldName)
    {
        return "'$fieldName'" . "=>\$this->faker->randomNumber(1)";
    }
}
