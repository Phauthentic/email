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
 * Callback Mailer
 */
class CallbackMailer implements MailerInterface
{
    /**
     * @var callable
     */
    protected $callback;

    /**
     * Constructor
     *
     * @param \Psr\Log\LoggerInterface
     */
    public function __construct(
        callable $callback
    ) {
        $this->callback = $callback;
    }

    /**
     * @inheritDoc
     */
    public function send(EmailInterface $email): bool
    {
        $callback = $this->callback;

        return $callback($email);
    }
}
