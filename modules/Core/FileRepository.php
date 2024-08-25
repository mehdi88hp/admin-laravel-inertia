<?php

namespace Modules\Core;

use Illuminate\Contracts\Filesystem\Factory as Filesystem;
use Illuminate\Http\UploadedFile;
//use Kaban\Models\TravelRequestUserDocument;

class FileRepository
{
    protected $filesystem;

    public function __construct(Filesystem $filesystem)
    {
        $this->filesystem = $filesystem->disk(
            config('general.default_upload_disk', 'sftp')
        );
    }

    /**
     * Delete possible existing document file
     *
     * @param $document
     * @return bool
     */
    public function deleteUserDocument($document)
    {
        if ($document->url) {
            return $this->filesystem->delete($document->url);
        }

        return true;
    }

    /**
     * Update document file
     *
     * @param TravelRequestUserDocument $document
     * @param UploadedFile $file
     * @return bool
     */
//    public function uploadUserDocument(TravelRequestUserDocument $document, UploadedFile $file)
//    {
//        $this->deleteUserDocument($document);
//
//        return $this->filesystem->put($document->filesPath(), $file);
//    }
}
