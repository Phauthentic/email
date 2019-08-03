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
use Phauthentic\Email\EmailAddressInterface;
use Phauthentic\Email\EmailInterface;
use Phauthentic\Email\HeaderCollection;
use Phauthentic\Email\Priority;
use PHPUnit\Framework\TestCase;

/**
 * MailGeneratorTrait
 */
trait MailGeneratorTrait {
    /**
     * @return \Phauthentic\Email\EmailInterface
     */
    protected function getSimpleTestMail(): EmailInterface
    {
        return Email::create(
            EmailAddress::create('me@test.com', 'Its me'),
            EmailAddressCollection::fromArray([
                EmailAddress::create('me@test.com', 'Its me')
            ]),
            null,
            null,
            'Test Swift mailer email',
            'hello',
            '<p>hello!</p>'
        );
    }
}
