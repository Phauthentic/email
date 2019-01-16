<?php
declare(strict_types=1);
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
namespace Phauthentic\Email\Mailer;

use Phauthentic\Email\EmailInterface;
use Psr\Log\LoggerInterface;

/**
 * Useful for test environments if you don't want to log the emails
 *
 * The mails are not send anywhere, the send() method will always return true.
 */
class NullMailer implements MailerInterface
{
    /**
     * @inheritDoc
     */
    public function send(EmailInterface $email): bool
    {
        return true;
    }
}
