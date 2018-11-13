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
namespace Phauthentic\Email\Mailer;

use Phauthentic\Email\EmailInterface;
use Psr\Log\LoggerInterface;

/**
 * Log Mailer
 *
 * Sends the email to a PSR logger instance. This is useful for debugging.
 */
class LogMailer implements MailerInterface
{
    /**
     * Logger
     *
     * @var \Psr\Log\LoggerInterface
     */
    protected $logger;

    /**
     *
     */
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * @inheritDoc
     */
    public function send(EmailInterface $email): bool
    {
        $this->logger->log($email);
    }
}
