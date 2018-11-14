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
use Phauthentic\Email\Mailer\PhpMailMailer;
use PHPUnit\Framework\TestCase;

/**
 * PhpMailMailerTest
 */
class PhpMailMailerTest extends TestCase
{
	public function testMailer() {
		$mailer = new PhpMailMailer();
		$email = (new Email())
			->setSender(new EmailAddress('me@test.com', 'Its me'))
			->setReceivers([
				new EmailAddress('me@test.com', 'Its me')
			])
			->setSubject('Test mailer() email')
			->setTextContent('hellp')
			->setHtmlContent('<p>hello!</p>');

		$result = $mailer->send($email);
		$this->assertTrue($result);
	}
}
