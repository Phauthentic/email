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
use Phauthentic\Email\Mailer\SwiftMailer;
use PHPUnit\Framework\TestCase;
use Swift_Events_SimpleEventDispatcher;
use Swift_Mailer;
use Swift_SmtpTransport;
use Swift_Transport_NullTransport;

/**
 * SwiftMailerTest
 */
class SwiftMailerTest extends TestCase
{
    use MailGeneratorTrait;

    /**
     * testSwiftMailer
     *
     * @return void
     */
    public function testSwiftMailer(): void
    {
        $email = $this->getSimpleTestMail();
        $transport = $this->getMockBuilder(Swift_SmtpTransport::class)->getMock();
        $swift = $this->getMockBuilder(Swift_Mailer::class)
            ->setConstructorArgs([$transport])
            ->setMethods([
                'send'
            ])
            ->getMock();

        $mailer = new SwiftMailer($swift);

        $swift->expects($this->atLeastOnce())
            ->method('send')
            ->willReturn(true);

        $result = $mailer->send($email);

        $this->assertTrue($result);
    }
}
