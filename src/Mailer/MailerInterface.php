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

/**
 * Mailer Interface
 *
 * Use this interface on decorator classes that wraps an implementation of a
 * mailer to make it framework agnostic.
 */
interface MailerInterface
{
    /**
     * Sends an email
     *
     * @param \App\Infrastructure\Email\EmailInterface
     * @return bool
     */
    public function send(EmailInterface $email): bool;
}
