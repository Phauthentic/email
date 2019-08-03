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
use Phauthentic\Email\Mailer\CallbackMailer;
use Phauthentic\Email\Mailer\PhpMailMailer;
use PHPMailer\PHPMailer\PHPMailer;
use PHPUnit\Framework\TestCase;

/**
 * CallbackMailerTest
 */
class CallbackMailerTest extends TestCase
{
    use MailGeneratorTrait;

    /**
     * @return void
     */
    public function testMailer()
    {
        $callable = function($mail) {
            return true;
        };

        $email = $this->getSimpleTestMail();
        $mailer = new CallbackMailer($callable);
        $result = $mailer->send($email);

        $this->assertTrue($result);

        $callable = function($mail) {
            return false;
        };

        $email = $this->getSimpleTestMail();
        $mailer = new CallbackMailer($callable);
        $result = $mailer->send($email);

        $this->assertFalse($result);
    }
}
