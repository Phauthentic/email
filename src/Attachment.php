<?php
declare(strict_types=1);
/**
 * Copyright (c) Phauthentic (https://github.com/Phauthentic)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Phauthentic (https://github.com/Phauthentic)
 * @link          https://github.com/Phauthentic
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */
namespace Phauthentic\Email;

use InvalidArgumentException;
use RuntimeException;
use Psr\Http\Message\UploadedFileInterface;

/**
 * Attachment
 */
class Attachment implements AttachmentInterface
{
    /**
     * @var string
     */
    protected $file;

    /**
     * @var string
     */
    protected $filename;

    /**
     * @var string
     */
    protected $contentType;

    /**
     * Constructor
     */
    private function __construct() {}

    public static function fromUploadedFile(UploadedFileInterface $uploadedFile)
    {

    }

    /**
     * Creates a new attachment from a given file
     *
     * @param string $file File
     * @return \Phauthentic\Email\AttachmentInterface
     */
    public static function fromFile(string $file): AttachmentInterface
    {
        $attachment = new self();
        $attachment->checkFile($path);
        $attachment->file = $path;
        $attachment->filename = basename($path);

        return $attachment;
    }

    /**
     * Checks the file if it exists and is readable
     *
     * @param string $file File to check
     * @return void
     */
    protected function checkFile($file)
    {
        if (!is_file($file)) {
            throw new RuntimeException(sprintf(
                'The file %s does not exist or is not a file',
                $file
            ));
        }

        if (!is_readable($file)) {
            throw new RuntimeException(sprintf(
                'The file %s is not readable',
                $file
            ));
        }
    }

    /**
     * Sets the file
     *
     * @param string $file File
     * @return \Phauthentic\Email\AttachmentInterface
     */
    public function setFile(string $path): AttachmentInterface
    {
        $this->checkFile($path);
        $this->file = $path;
        $this->filename = basename($path);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setContentType(string $contentType): AttachmentInterface
    {
        $this->contentType = $contentType;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setFilename(string $filename): AttachmentInterface
    {
        $this->filename = $filename;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getFilename(): string
    {
        return $this->filename;
    }

    /**
     * @inheritDoc
     */
    public function getContentType(): string
    {
        $this->contentType;
    }

    /**
     * @inheritDoc
     */
    public function getFile(): string
    {
        if (empty($this->file)) {
            throw new RuntimeException('No file was set');
        }

        return $this->file;
    }
}
