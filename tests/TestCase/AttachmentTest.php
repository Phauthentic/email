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
namespace Phauthentic\Email\Test\TestCase;

use Phauthentic\Email\Attachment;
use PHPUnit\Framework\TestCase;

/**
 * Attachment Test
 */
class AttachmentTest extends TestCase
{
    /**
     * testEmail
     *
     * @return void
     */
    public function testAttachment(): void
    {
        $file = TESTS . 'Fixture' . DS . 'attachment.txt';
        $attachment = Attachment::fromFile($file);

        $this->assertEquals($file, $attachment->getFile());
        $this->assertEquals('attachment.txt', $attachment->getFilename());

        $attachment->setFilename('renamed.txt');
        $this->assertEquals('renamed.txt', $attachment->getFilename());
    }

    /**
     * testAttachmentNoFileException
     *
     * @expectedException \RuntimeException
     * @return void
     */
    public function testAttachmentFileDoesNotExistException(): void
    {
        $attachment = Attachment::fromFile('does-not-exist');
    }

    /**
     * testAttachmentNoFileException
     *
     * @expectedException \RuntimeException
     * @return void
     */
    public function testAttachmentNoFileException(): void
    {
        $file = TESTS . 'Fixture' . DS;
        $attachment = Attachment::fromFile($file);
    }
}
