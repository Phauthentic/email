<?php
declare(strict_types=1);
/**
 * Copyright (c) Phauthentic (https://github.com/Phauthentic)
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Phauthentic (https://github.com/Phauthentic)
 * @link          https://github.com/Phauthentic
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

namespace Phauthentic\Email;

/**
 * Attachment Interface
 */
interface AttachmentInterface
{
    /**
     *
     */
    public static function fromPath(string $path): AttachmentInterface;

    /**
     * @return \Phauthentic\Email\AttachmentInterface
     */
    public function setContentType(string $contentType): AttachmentInterface;

    /**
     *
     */
    public function setData($data): AttachmentInterface;

    /**
     * @return string
     */
    public function setFileName(string $filename): AttachmentInterface;

    /**
     *
     */
    public function getData();

    /**
     * Gets the filename
     *
     * @return string
     */
    public function getFileName(): string;

    /**
     * Gets the mime content type
     *
     * @return string
     */
    public function getContentType(): string;

    /**
     * Gets the path of the file
     *
     * @return string
     */
    public function getPath(): string;
}
