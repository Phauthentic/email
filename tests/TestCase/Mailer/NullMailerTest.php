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

use Phauthentic\Email\Mailer\NullMailer;
use PHPUnit\Framework\TestCase;

/**
 * NullMailerTest
 */
class NullMailerTest extends TestCase
{
    use MailGeneratorTrait;

    /**
     * @return void
     */
    public function testMailer()
    {
        $email = $this->getSimpleTestMail();
        $mailer = new NullMailer();
        $result = $mailer->send($email);
        $this->assertTrue($mailer->send($email));
    }
}
