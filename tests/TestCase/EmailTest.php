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
use Phauthentic\Email\EmailAddressCollection;
use Phauthentic\Email\EmailAddressCollectionInterface;
use Phauthentic\Email\EmailAddressInterface;
use Phauthentic\Email\HeaderCollection;
use Phauthentic\Email\HeaderCollectionInterface;
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
        $email = Email::create(
            EmailAddress::create('foo@bar.com'),
            EmailAddressCollection::fromArray([
                EmailAddress::create('bar@foo.com')
            ]),
            null,
            null,
            'Test Subject',
            'text',
            'html'
        );

        $email
            ->setCc(EmailAddressCollection::fromArray([
                EmailAddress::create('cc@test.com'),
            ]))
            ->setBcc(EmailAddressCollection::fromArray([
                EmailAddress::create('bcc@test.com'),
                EmailAddress::create('bcc2@test.com')
            ]))
            ->setTextContent('text')
            ->setHtmlContent('html')
            ->setReceivers(EmailAddressCollection::fromArray([
                EmailAddress::create('bar@foo.com')
            ]))
            ->addAttachment(Attachment::fromFile(TESTS . 'Fixture' . DS . 'attachment.txt'))
            ->setMessageId('messageId!')
            ->setPriority(Priority::LOWEST)
            ->setHeaders(HeaderCollection::fromArray([
                'foo' => 'bar'
            ]));

        $this->assertEquals('Test Subject', $email->getSubject());
        $this->assertInstanceOf(EmailAddressInterface::class, $email->getSender());
        $this->assertEquals('foo@bar.com', (string)$email->getSender());
        $this->assertEquals('text', $email->getTextContent());
        $this->assertEquals('html', $email->getHtmlContent());
        $this->assertInstanceOf(EmailAddressCollectionInterface::class,  $email->getReceivers());
        $this->assertInstanceOf(EmailAddressCollectionInterface::class, $email->getBcc());
        $this->assertInstanceOf(EmailAddressCollectionInterface::class, $email->getcc());
        $this->assertCount(1, $email->getReceivers());
        $this->assertCount(2, $email->getBcc());
        $this->assertCount(1, $email->getCc());
        $this->assertCount(1, $email->getAttachments());
        $this->assertEquals('messageId!', $email->getMessageId());
        $this->assertEquals(Priority::LOWEST, $email->getPriority());
        $this->assertInstanceOf(HeaderCollectionInterface::class,  $email->getHeaders());
    }
}
