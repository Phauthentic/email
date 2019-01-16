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
use Psr\Log\LogLevel;

/**
 * Doesn't send emails but logs them instead
 */
class LogMailer implements MailerInterface
{
    /**
     * Logger
     *
     * @var \Psr\Log\LoggerInterface
     */
    protected $Logger;

    /**
     * Log Level
     *
     * @var string
     */
    protected $logLevel;

    /**
     * Constructor
     *
     * @param \Psr\Log\LoggerInterface
     */
    public function __construct(
        LoggerInterface $logger,
        $logLevel = LogLevel::INFO
    ) {
        $this->Logger;
        $this->logLevel = $logLevel;
    }

    /**
     * @inheritDoc
     */
    public function send(EmailInterface $email): bool
    {
        $this->Logger->log($this->logLevel, $email);

        return true;
    }
}
