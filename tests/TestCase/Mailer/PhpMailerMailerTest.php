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
use Phauthentic\Email\Mailer\PHPMailerMailer;
use PHPMailer\PHPMailer\PHPMailer;
use PHPUnit\Framework\TestCase;

/**
 * PhpMailMailerTest
 */
class PhpMailerMailerTest extends TestCase
{
    use MailGeneratorTrait;

    /**
     * testMailer
     *
     * @return void
     */
    public function testMailer(): void
    {
        $email = $this->getSimpleTestMail();
        $phpmailer = new PHPMailer();
        $phpmailer = $this->getMockBuilder(PHPMailer::class)
            ->getMock();
        $mailer = new PHPMailerMailer($phpmailer);

        $phpmailer->expects($this->atLeastOnce())
            ->method('send')
            ->willReturn(true);

        $result = $mailer->send($email);
        $this->assertTrue($result);
    }
}
