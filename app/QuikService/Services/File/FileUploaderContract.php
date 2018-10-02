<?php

namespace App\QuikService\Services\File;

use Illuminate\Http\UploadedFile;

interface FileUploaderContract
{
    /**
     * Save the corporate file.
     *
     * @param string $corporateId The corporate uuid
     * @return array Returns the saved filename along with the original filename
     */
    public function saveCorporateFile($corporateId);

    /**
     * Save the corporate employee file.
     *
     * @param string $corporateId The corporate uuid
     * @return array Returns the saved filename along with the original filename
     */
    public function saveCorporateEmployeeFile($corporateId);

    /**
     * Set the uploaded image file to manipulate.
     *
     * @param \Illuminate\Http\UploadedFile $file
     * @return $this
     */
    public function file(UploadedFile $file);

    /**
     * Set the storage disk.
     *
     * @param string $disk
     * @return $this
     */
    public function disk(string $disk);
}
