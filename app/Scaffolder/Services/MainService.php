<?php

namespace App\Scaffolder\Services;

use App\Scaffolder\Services\ReplaceHandlers\HandleControllerTest;
use App\Scaffolder\Services\ReplaceHandlers\HandleFactory;
use App\Scaffolder\Services\ReplaceHandlers\HandleGeneral;
use App\Scaffolder\Services\ReplaceHandlers\HandlePostForm;
use App\Scaffolder\Services\ReplaceHandlers\HandleStoreRequest;
use App\Scaffolder\Services\ReplaceHandlers\HandleUpdateRequest;
use App\Scaffolder\Services\ReplaceHandlers\IHandler;
use Illuminate\Support\Facades\Process;

class MainService
{
    protected $componentName;

    protected $patternSingular = 'post';

    protected $patternPolural = 'posts';

    public $fields = [];

    public $replaceHandlers = [
        HandleGeneral::class,
        HandleUpdateRequest::class,
        HandleStoreRequest::class,
        HandlePostForm::class,
        HandleFactory::class,
        HandleControllerTest::class,
    ];

    public $files = [];

    public function createComponent()
    {
        $filesAndFolders = Filesystem::make()
            ->getDirContents(__DIR__ . '/../Sample');

        foreach ($filesAndFolders as $file) {
            if (!is_dir($file)) {
                $this->makeNewFile($file);
            }
        }

        Process::command(base_path() . '/vendor/bin/pint ../target')->run();

        ZipService::zip(base_path() . '/target', $this->componentName);
    }

    public function makeNewFile($path)
    {
        $content = file_get_contents($path);
        $newPath = $path;
        /** @var IHandler $handler */
        foreach ($this->replaceHandlers as $handler) {
            $handler = (new $handler(
                componentName: $this->componentName,
                patternSingular: $this->patternSingular,
                patternPolural: $this->patternPolural,
            ))->handle($path);

            $content = $handler->newContent($content);
            $newPath = $handler->newPath($path) ?? $newPath;
        }

        $newPath = str_replace('app/Scaffolder/Sample', 'target', $newPath);

        Filesystem::make()->fileForceContents(
            $newPath,
            $content
        );

        return 1;
    }

    public function setComponentName(string $componentName): MainService
    {
        $this->componentName = $componentName;

        return $this;
    }

    public function setFields(array $fields): MainService
    {
        $this->fields = $fields;

        return $this;
    }

    public function getFields(): string
    {
        if (!$this->fields) {
            abort(501, 'component name should be provided');
        }

        return $this->fields;
    }
}
