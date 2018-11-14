<?php
declare(strict_types = 1);
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

/**
 * Attachment
 */
class Attachment implements AttachmentInterface
{
    /**
     * @var array
     */
    protected $data;

    /**
     * @var string
     */
    protected $path;

    /**
     * @var string
     */
    protected $filename;

    /**
     * @var string
     */
    protected $contentType;

    /**
     * @inheritDoc
     */
    public static function fromPath(string $path): AttachmentInterface
    {
        if (!file_exists($path)) {
            throw new InvalidArgumentException(sprintf('File %s does not exist'));
        }

        if (!is_readable($path)) {
            throw new RuntimeException('File is not readable');
        }

        return (new static())
            ->setData(file_get_contents($path))
            ->setFileName(basename($path))
            ->setContentType(mime_content_type($path));
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
    public function setData($data): AttachmentInterface
    {
        if (is_resource($data)) {
            if (get_resource_type($data) === 'stream') {
                return $data->read();
            }
        }

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setFileName(string $filename): AttachmentInterface
    {
        $this->filename = $filename;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getData() {
        return $this->data;
    }

    /**
     * @inheritDoc
     */
    public function getFileName(): string
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
    public function getPath(): string
    {
        return $this->path;
    }
}
