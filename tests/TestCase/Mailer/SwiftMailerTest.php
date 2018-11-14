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
    /**
     * testSwiftMailer
     *
     * @return void
     */
    public function testSwiftMailer(): void
    {
        $email = (new Email())
            ->setSender(new EmailAddress('me@test.com', 'Its me'))
            ->setReceivers([
                new EmailAddress('me@test.com', 'Its me')
            ])
            ->setSubject('Test Swift mailer email')
            ->setTextContent('hellp')
            ->setHtmlContent('<p>hello!</p>');

        $transport = new Swift_SmtpTransport('127.0.0.1', 1025);
        $swift = new Swift_Mailer($transport);

        $mailer = new SwiftMailer($swift);

        $result = $mailer->send($email);

        $this->assertTrue($result);
    }
}
