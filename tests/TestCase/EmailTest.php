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
use Phauthentic\Email\Email;
use Phauthentic\Email\EmailAddress;
use Phauthentic\Email\EmailAddressInterface;
use Phauthentic\Email\Priority;
use PHPUnit\Framework\TestCase;

/**
 * Email Test
 */
class EmailTest extends TestCase
{
    /**
     * testEmail
     *
     * @return void
     */
    public function testEmail(): void
    {
        $email = new Email();
        $email
            ->setSubject('Test Subject')
            ->setSender(new EmailAddress('foo@bar.com'))
            ->setCc([
                new EmailAddress('cc@test.com'),
            ])
            ->setBcc([
                new EmailAddress('bcc@test.com'),
                new EmailAddress('bcc2@test.com')
            ])
            ->setTextContent('text')
            ->setHtmlContent('html')
            ->setReceivers([new EmailAddress('bar@foo.com')])
            ->addAttachment(new Attachment(TESTS . 'Fixture' . DS . 'attachment.txt'))
            ->setMessageId('messageId!')
            ->setPriority(Priority::LOWEST)
            ->setHeaders([
                'foo' => 'bar'
            ]);

        $this->assertEquals('Test Subject', $email->getSubject());
        $this->assertInstanceOf(EmailAddressInterface::class, $email->getSender());
        $this->assertEquals('foo@bar.com', (string)$email->getSender());
        $this->assertEquals('text', $email->getTextContent());
        $this->assertEquals('html', $email->getHtmlContent());
        $this->assertInternalType('array', $email->getReceivers());
        $this->assertInternalType('array', $email->getBcc());
        $this->assertInternalType('array', $email->getcc());
        $this->assertCount(1, $email->getReceivers());
        $this->assertCount(2, $email->getBcc());
        $this->assertCount(1, $email->getCc());
        $this->assertCount(1, $email->getAttachments());
        $this->assertEquals('messageId!', $email->getMessageId());
        $this->assertEquals(Priority::LOWEST, $email->getPriority());
        $this->assertEquals(['foo' => 'bar'],  $email->getHeaders());
    }

    /**
     * testMissingSender
     *
     * @expectedException \RuntimeException
     * @return void
     */
    public function testMissingSender()
    {
        (new Email())->getSender();
    }

    /**
     * testMissingReceiver
     *
     * @expectedException \RuntimeException
     * @return void
     */
    public function testMissingReceiver(): void
    {
        (new Email())->getReceivers();
    }
}
