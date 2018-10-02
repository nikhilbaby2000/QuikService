<?php

namespace App\QuikService\Services\File;

use Storage;
use Exception;
use Illuminate\Http\UploadedFile;
use Illuminate\Config\Repository as ConfigRepository;
use App\QuikService\Services\Hash\HashGeneratorContract;

class FileUploader implements FileUploaderContract
{
    /**
     * The HashGenerator instance.
     *
     * @var \App\QuikService\Services\Hash\HashGeneratorContract
     */
    protected $hashGenerator;

    /**
     * The config array.
     *
     * @var array
     */
    protected $config;

    /**
     * The storage disk to use.
     *
     * @var string
     */
    protected $disk;

    /**
     * The uploaded file.
     *
     * @var \Illuminate\Http\UploadedFile|null
     */
    protected $file = null;

    /**
     * FileUploader constructor.
     *
     * @param \App\QuikService\Services\Hash\HashGeneratorContract $hashGenerator
     * @param \Illuminate\Config\Repository $config
     */
    public function __construct(HashGeneratorContract $hashGenerator, ConfigRepository $config)
    {
        $this->hashGenerator = $hashGenerator;
        $this->config = $config['QuikService'];
    }

    /**
     * Save the corporate file.
     *
     * @param string $corporateId The corporate uuid
     * @return array Returns the saved filename along with the original filename
     */
    public function saveCorporateFile($corporateId)
    {
        $this->validateFile();

        return $this->storeFile(
            $this->config('corporate.upload.file.path'),
            $this->generateFileName(),
            $corporateId
        );
    }

    /**
     * Save the corporate employee file.
     *
     * @param string $corporateId The corporate uuid
     * @return array Returns the saved filename along with the original filename
     */
    public function saveCorporateEmployeeFile($corporateId)
    {
        $this->validateFile();

        return $this->disk('local')->storeFile(
            $this->config('corporate.files.employee'),
            $this->generateFileName(),
            $corporateId
        );
    }

    /**
     * Set the uploaded image file to manipulate.
     *
     * @param \Illuminate\Http\UploadedFile $file
     * @return $this
     */
    public function file(UploadedFile $file)
    {
        $this->file = $file;

        return $this;
    }

    /**
     * Set the storage disk.
     *
     * @param string $disk
     * @return $this
     */
    public function disk(string $disk)
    {
        $this->disk = $disk;

        return $this;
    }

    /**
     * Store the file and return the filename along with the original file name.
     *
     * @param string $path
     * @param string $filename
     * @param string|null $folder
     * @return array
     */
    protected function storeFile(string $path, string $filename, string $folder = null)
    {
        $filePath = folder_merge($path, $folder);

        Storage::disk($this->disk)->putFileAs($filePath, $this->file, $filename);

        $originalFilename = $this->getFileOriginalName();

        return [$filename, $originalFilename ?: $filename];
    }

    /**
     * Generate a unique hash based file name.
     *
     * @return string
     */
    protected function generateFileName()
    {
        return $this->hashGenerator
            ->extension($this->getFileExtension())
            ->make();
    }

    /**
     * Get the config value.
     *
     * @param string $key
     * @param mixed|null $default
     * @return mixed
     */
    protected function config($key, $default = null)
    {
        return data_get($this->config, $key, $default);
    }

    /**
     * Check if the file is set.
     *
     * @throws Exception
     */
    protected function validateFile()
    {
        if (is_null($this->file)) {
            throw new Exception('File uploader: No file provided.');
        }
    }

    /**
     * Guess the extension of the uploaded file.
     *
     * @return string|null
     */
    protected function getFileExtension()
    {
        return $this->file->getClientOriginalExtension();
    }

    /**
     * Get the original name of the uploaded file.
     *
     * @return string|null
     */
    protected function getFileOriginalName()
    {
        $filename = $this->file->getClientOriginalName();

        if (!$filename) {
            return null;
        }

        return str_limit($filename, 100, ".{$this->getFileExtension()}");
    }
}
