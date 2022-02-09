<?php

namespace App\Services;
use App\Exceptions\CanNotMakeZipFileException;
use App\Exceptions\CompressedFilePathException;
use App\Exceptions\CompressedFileTypeException;
use ZipArchive;

class CompressionService
{
    /**
     * @var string $type
     */
    private string $type;

    /**
     * @var string $saveCompressedToPath
     */
    private string $saveCompressedToPath;

    /**
     * @var string $fileName
     */
    private string $fileName;

    /**
     * @var string $fileToCompress
     */
    private string $fileToCompress;

    public function __construct(
        string $type,
        string $saveCompressedToPath,
        string $fileName,
        string $fileToCompress
    )
    {
        $this->type = $type;
        $this->saveCompressedToPath = $saveCompressedToPath;
        $this->fileName = $fileName;
        $this->fileToCompress = $fileToCompress;
    }

    /**
     * For sometimes we want to set type for different situations.
     * I made this for testing.
     *
     * @param string $type
     * @return void
     */
    public function setType(string $type)
    {
        $this->type = $type;
    }

    /**
     * Compress file
     *
     * @return string
     * @throws CanNotMakeZipFileException
     * @throws CompressedFilePathException
     * @throws CompressedFileTypeException
     */
    public function compress(): string
    {
        $zipFile = "{$this->saveCompressedToPath}/{$this->fileName}.{$this->type}";
        $zip = new ZipArchive();

        if (! in_array($this->type, config('compression.allowedFileTypes'))) {
            throw new CompressedFileTypeException();
        }

        if (! $zip->open($zipFile, ZipArchive::CREATE)) {
            throw new CompressedFilePathException();
        }

        if (! $zip->addFile($this->fileToCompress, basename($this->fileToCompress))) {
            throw new CanNotMakeZipFileException();
        }

        /** Close zipArchive */
        $zip->close();

        return $zipFile;
    }
}
