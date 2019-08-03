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

use Phauthentic\Email\Email;
use Phauthentic\Email\EmailAddress;
use Phauthentic\Email\EmailAddressCollection;
use Phauthentic\Email\Mailer\PhpMailMailer;
use Phauthentic\Email\Mailer\SendmailMailer;
use PHPUnit\Framework\TestCase;

/**
 * PhpMailMailerTest
 */
class SendmailMailerTest extends TestCase
{
    use MailGeneratorTrait;

    /**
     * testMailer
     *
     * @reteurn void
     */
    public function testMailer(): void
    {
        $mailer = $this->getMockBuilder(SendmailMailer::class)
            ->setMethods([
                'mail'
            ])
            ->getMock();

        $email = $email = $this->getSimpleTestMail();

        $mailer->expects($this->once())
            ->method('mail')
            ->willReturn(true);

        $result = $mailer->send($email);
        $this->assertTrue($result);
    }
}
